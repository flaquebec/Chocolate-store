<?php 

class DB extends PDO
{
    private $query;
    private $parameters = [];
    private $orderBy = [];

    public function __construct()
    {
        try {
          parent::__construct('mysql:host=mysql_app;dbname=app', 'root', 'secret');
          $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo 'ERROR: ' . $e->getMessage();
          exit;
        }
    }

    public function query($query)
    {
      $this->query = $query;
      return $this;
    }

    public function getQuery()
    {
      $query = $this->query;
      if (!empty($this->orderBy)) {
        $orderBy = [];
        foreach ($this->orderBy as $column => $direction) {
          $orderBy[] = " $column $direction";
        }
        $query = "$query ORDER BY " . implode(', ', $orderBy);
      }
      return $query;
    }

    public function parameters($parameters)
    {
      $this->parameters = $parameters;
      return $this;
    }

    public function orderBy($orderBy)
    {
      $this->orderBy = $orderBy;
      return $this;
    }

    public function get()
    {
      $statement = $this->prepare($this->getQuery());
      $statement->execute($this->parameters);
      return $statement->fetchAll();
    }

    public function first()
    {
      $statement = $this->prepare($this->getQuery());
      $statement->execute($this->parameters);
      return $statement->fetch();
    }

    public function paginate()
    {
      $count_sql      = "SELECT COUNT(1) AS total FROM({$this->query}) AS paginate";
      
      $statement      = $this->prepare($count_sql);
      $statement->execute($this->parameters);
      $result         = $statement->fetch();


      $total          = intval($result['total']);
      $per_page       = 15;
      $pages          = intval(ceil($total / $per_page));
      $offset         = '';
      $current_page   = 1;
      $last_page      = $pages;
      $from           = 1;
      $to             = $per_page;
      $page_numbers      = [];
      $interval       = 4;
      
      if (isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1) {
        $current_page = intval($_GET['page']);
        if ($current_page > $pages) {
          $current_page = $pages;
        }
        $offset = $per_page * ($current_page - 1);
        $from   = ($offset - $per_page) + $per_page;
        $to     = $offset + $per_page;
        if ($to > $total) {
          $to = $total;
        }
        
        $offset = " OFFSET $offset";
      }

      $begin        = $current_page;
      $end          = $current_page;
      
      while (($end - $begin) < $interval) {
        $begin--;
        $end++;
      }

      while ($begin < 1) {
        $begin++;
        $end++;
      }
      
      while ($end < $begin + $interval) {
        $end++;
      }

      if ($end > $pages) {
        $end = $pages;
      }

      while (($end - $interval) < $begin) {
        $begin--;
      }

      if ($begin < 1) {
        $begin = 1;
      }

      $current_url = parse_url($_SERVER['REQUEST_URI']);
      parse_str($current_url['query']??'', $current_parameters);
      if (!empty($this->orderBy)) {
        foreach ($this->orderBy as $column => $direction) {
          $current_parameters['orderBy'] = [
            "" . urlencode($column) . "" => urlencode($direction)
          ];
        }
      }
      
      $first_page_url = $current_page == 1 ? null : $current_url['path'] . '?' . http_build_query(array_merge ($current_parameters, ['page' => 1]));
      $last_page_url  = $current_page == $last_page ? null : $current_url['path'] . '?' . http_build_query(array_merge ($current_parameters, ['page' => $last_page]));
      
      for ($i = $begin; $i <= $end; $i++) {
        $selected = $current_page === $i;
        $page_numbers[$i] = [
          'url' => $selected ? null : $current_url['path'] . '?' . http_build_query(array_merge ($current_parameters, ['page' => $i])), 
          'selected' => $selected
        ];
      }

      $previous_page = $current_page - 1;
      $previous_page_url = $current_page == 1 ? null : $current_url['path'] . '?' . http_build_query(array_merge ($current_parameters, ['page' => $previous_page]));
      if ($previous_page < 1) {
        $previous_page = null;
        $previous_page_url = null;
      }
      
      
      $next_page = $current_page + 1;
      $next_page_url = $current_page == 1 ? null : $current_url['path'] . '?' . http_build_query(array_merge ($current_parameters, ['page' => $next_page]));
      if ($next_page > $pages) {
        $next_page = null;
        $next_page_url = null;
      }

      $statement = $this->prepare("{$this->getQuery()} LIMIT $per_page$offset");
      $statement->execute($this->parameters);
      $data = $statement->fetchAll();

      return [
        'total' => $total,
        'per_page' => $per_page,
        'previous_page' => $previous_page,
        'current_page' => $current_page,
        'next_page' => $next_page,
        'last_page' => $last_page,
        'from' => $from,
        'to' => $to,
        'begin' => $begin,
        'end' => $end,
        'data' => $data,
        'page_numbers' => $page_numbers,
        'first_page_url' => $first_page_url,
        'last_page_url' => $last_page_url,
        'previous_page_url' => $previous_page_url,
        'next_page_url' => $next_page_url,
      ];

    }
}
