<?php

if(! function_exists('format_rupiah')) {
    /**
     * Format Rupiah
     * @param mixed $str
     * @return void
     */
    function format_rupiah($str)
    {
        return 'Rp. ' . number_format($str, '2',',','.');
    }
}
