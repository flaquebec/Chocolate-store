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


function pagination($datasource) {

    $html  = '<nav class="pageBox mt-4" aria-label="Navegação de página">';
    $html .= '<ul class="pagination justify-content-center">';

    $html .= '<li class="page-item' . ($datasource['first_page_url'] == null ? '' : ' disabled') . '">';
    $html .= '<a class="page-link btn simpleBtn" href="' . ($datasource['first_page_url'] == null ? '#' : $datasource['first_page_url']) . '"><i class="fa fa-fast-backward"></i></a>';
    $html .= '</li>';
    $html .= '<li class="page-item' . ($datasource['previous_page_url'] == null ? '' : ' disabled') . '">';
    $html .= '<a class="page-link btn simpleBtn" href="' . ($datasource['previous_page_url'] == null ? '#' : $datasource['first_page_url']) . '">Anterior</a>';
    $html .= '</li>';

    foreach ($datasource['page_numbers'] as $number => $page) {
        $html .= '<li class="page-item' . ($page['selected'] ? ' disabled' : '') . '">';
        $html .= '<a class="page-link" href="' . ($page['selected'] ? '#' : $page['url']) . '">' . $number . '</a>';
        $html .= '</li>';
    }

    $html .= '<li class="page-item' . ($datasource['previous_page_url'] == null ? '' : ' disabled') . '">';
    $html .= '<a class="page-link btn simpleBtn" href="' . ($datasource['previous_page_url'] == null ? '#' : $datasource['previous_page_url']) . '">Próximo</a>';
    $html .= '</li>';
    $html .= '<li class="page-item' . ($datasource['last_page_url'] == null ? '' : ' disabled') . '">';
    $html .= '<a class="page-link btn simpleBtn" href="' . ($datasource['last_page_url'] == null ? '#' : $datasource['last_page_url']) . '"><i class="fa fa-fast-forward"></i></a>';
    $html .= '</li>';

    $html .= '</ul>';
    $html .= '</nav>';

    echo $html;
}