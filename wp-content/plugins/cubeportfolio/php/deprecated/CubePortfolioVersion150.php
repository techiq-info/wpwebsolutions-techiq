<?php

/**
*
*/
class CubePortfolioVersion150
{
    // wordpress global db
    private $wpdb;

    public function __construct()
    {
        global $wpdb;

        // store global db instance
        $this->wpdb = $wpdb;

        $this->editCustomcssAndloadMorehtml();

    }

    // @deprecation change `cbp-l-loadMore-button-` to `cbp-l-loadMore-`
    private function editCustomcssAndloadMorehtml()
    {
        $table_cbp = CubePortfolioMain::$table_cbp;

        $records = $this->wpdb->get_results("SELECT id, customcss, loadMorehtml FROM $table_cbp", ARRAY_A);

        foreach ($records as $key => $value) {

            $value['loadMorehtml'] = str_replace('cbp-l-loadMore-button-', 'cbp-l-loadMore-', $value['loadMorehtml']);
            $value['customcss'] = str_replace('cbp-l-loadMore-button-', 'cbp-l-loadMore-', $value['customcss']);

            $this->wpdb->update($table_cbp,
                                array('loadMorehtml' => $value['loadMorehtml'],
                                      'customcss' => $value['customcss'],
                                ),
                                array('id' => $value['id']),
                                array('%s'),
                                array('%d')
                                );

        }
    }
}
