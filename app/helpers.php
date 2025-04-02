<?php

//if( !function_exists('render_html_tag') ) {
//    function render_html_tag($tagName, $id = null, $attrs = ['title' => null, 'alt' => null])
//    {
//
//    }
//}

if( !function_exists('render_flag_html') ) {
    function render_flag_html(string $flag_region, $attrs = []): string
    {
//        $valid_flag_keys = ['aus', 'bzl', 'can', 'eec', 'esp', 'fra', 'gbr', 'ger', 'hk', 'hol', 'ita', 'jap', 'kor', 'scn', 'swe', 'twn', 'usa'];
//
//        if( !in_array($flag_key, $valid_flag_keys) ) {
//            return "";
//        }

        $flag_html_tag_attributes = [
//            'src' => asset('images/flag_' . $flag_key . '.gif'),
            'src' => asset(match($flag_region) {
                'Australia' => "images/flag_aus.gif",
                'Brazil' => "images/flag_bzl.gif",
                'Canada' => "images/flag_can.gif",
                'Europe' => "images/flag_eec.gif",
                'France' => "images/flag_fra.gif",
                'Germany' => "images/flag_ger.gif",
                'Hong Kong' => "images/flag_hk.gif",
                'Italy' => "images/flag_ita.gif",
                'Japan' => "images/flag_jap.gif",
                'Netherlands' => "images/flag_hol.gif",
                'Scandinavia' => "images/flag_scn.gif",
                'South Korea' => "images/flag_kor.gif",
                'Spain' => "images/flag_esp.gif",
                'Sweden' => "images/flag_swe.gif",
                'Taiwan' => "images/flag_twn.gif",
                'United Kingdom' => "images/flag_gbr.gif",
                'USA' => "images/flag_usa.gif",
                default => "images/flag_unknown.gif",
            }),
//            'title' => (isset($attrs['title']) && is_string($attrs['title']) && strlen($attrs['title']) > 0 ? $attrs['title'] : ''),
//            'alt' => (isset($attrs['alt']) && is_string($attrs['alt']) && strlen($attrs['alt']) > 0 ? $attrs['alt'] : ''),
            'title' => $flag_region,
            'alt' => $flag_region,
            'width' => (isset($attrs['width']) && is_int($attrs['width']) && $attrs['width'] >= 0 ? $attrs['width'] : 22),
            'height' => (isset($attrs['height']) && is_int($attrs['height']) && $attrs['height'] >= 0 ? $attrs['height'] : 16),
            'border' => (isset($attrs['border']) && is_int($attrs['border']) && $attrs['border'] >= 0 ? $attrs['border'] : 0),
        ];

//        $flag_img_src = asset(match($flag_region) {
//            'Australia' => "images/flag_aus.gif",
//            'Brazil' => "images/flag_bzl.gif",
//            'Canada' => "images/flag_can.gif",
//            'Europe' => "images/flag_eec.gif",
//            'France' => "images/flag_fra.gif",
//            'Germany' => "images/flag_ger.gif",
//            'Hong Kong' => "images/flag_hk.gif",
//            'Italy' => "images/flag_ita.gif",
//            'Japan' => "images/flag_jap.gif",
//            'Netherlands' => "images/flag_hol.gif",
//            'Scandinavia' => "images/flag_scn.gif",
//            'South Korea' => "images/flag_kor.gif",
//            'Spain' => "images/flag_esp.gif",
//            'Sweden' => "images/flag_swe.gif",
//            'Taiwan' => "images/flag_twn.gif",
//            'United Kingdom' => "images/flag_gbr.gif",
//            'USA' => "images/flag_usa.gif",
//            default => "images/flag_unknown.gif",
//        });

//        $flag_img_html_tag = "";
        $img_tag_opening = '<img';
        $img_tag_closing = '/>';



        $flag_img_html_tag = $img_tag_opening;

//        $flag_img_html_tag .= (' src="'
//            . asset('images/flag_' . $flag_key . '.gif')
//            . '"');

        foreach($flag_html_tag_attributes as $attrKey => $attrValue) {
            $flag_img_html_tag .= (' ' . $attrKey . '="' . $attrValue . '"');
        }


//        $flag_img_html_tag .= asset('images/flag_' . $flag_key . '.gif');
//        $flag_img_html_tag .= '"';

        $flag_img_html_tag .= $img_tag_closing;
        return $flag_img_html_tag;





//        return '<img src="' . asset('images/flag_' . $flag_key . '.gif') . '"' . (isset($attrs['title']) && is_string($attrs['title']) && strlen($attrs['title']) > 0 ? ' title="' . $attrs['title'] . '"' : '') . '>';
//        <img src="/img/flag_JAP.gif" title="Japan" alt="Japan" width="22" height="16" border="0">
    }
}



if( !function_exists('render_producer_image_html') ) {
    function render_producer_image_html(string $producer_string): string
    {
        return '<img src="' . asset(match($producer_string) {
                'Nintendo (NES)', 'Nintendo' => "images/prod_nintendo.png",
                'Nintendo (Famicom)' => "images/prod_famicom.png",
                default => "images/prod_unknown.png",
            }) . '" border="0" vspace="0" alt="' . $producer_string . '" title="' . $producer_string . '">';
    }
}
