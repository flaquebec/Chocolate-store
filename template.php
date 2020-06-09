<?php 

function th_orderBy($name, $column, $rowspan = 0) 
{
    $current_url = parse_url($_SERVER['REQUEST_URI']);
    parse_str($current_url['query'] ?? '', $current_parameters);
    $orderBy = $current_parameters['orderBy'] ?? [];
    
    unset($current_parameters['orderBy']);
    
    $direction  = 'ASC';
    $icon       = 'fa-sort';
    $selected   = false;
    if (array_key_exists($column, $orderBy)) {
        if ($orderBy[$column] == 'ASC') {
            $direction = 'DESC';
        }
        $icon       .= '-' . strtolower($direction);
        $selected    = true;
    }
    
    $current_parameters['orderBy'] = [$column => $direction];
    $url = $current_url['path'] . '?' . http_build_query($current_parameters);
    

    $icon_sort = '&nbsp;<i class="fa ' . $icon . '" aria-hidden="true"></i>';

    echo '<th' . ($rowspan ? " rowspan=\"$rowspan\"" : '') . '><a href="' . $url . '"' . ($selected ? ' class="sort"' : '') . '>' . $name . $icon_sort . '</a></th>';
}
?>