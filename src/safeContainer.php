<?php

/**
 *
 * @package    safeContainer
 * @version    Release: 1.0.0
 * @license    GPL3
 * @author     Ali YILMAZ <aliyilmaz.work@gmail.com>
 * @category   Safe content area.
 * @link       https://github.com/aliyilmaz/safeContainer
 *
 */
class safeContainer extends Mind
{

    /**
     * safeContainer
     * 
     * @param string $str
     * @param string|array|null $rule
     * @return string
     */
    public function safeContainer($str, $rule=null){

        // Special characters are being decoded.
        if(self::aliyilmaz('is_htmlspecialchars')->is_htmlspecialchars($str)){
            $str = htmlspecialchars_decode($str); }

        // The specified set of rules.
        $newRules = [];

        // The set of allowed rules.
        $rules = array('inlinejs', 'inlinecss', 'tagjs', 'tagcss', 'iframe');
        
        // If only one rule is specified, it is defined to the new rule set.
        if(!is_null($rule) AND !is_array($rule) AND in_array($rule, $rules)){
            $newRules[] = $rule; }
        
        // If multiple rules are specified, they are assigned to the new rule set.
        if(is_array($rule)) {
            foreach ($rule as $r) { if(in_array($r, $rules)) $newRules[] = $r; }}

        // It is ensured that the new rules override the old ones.
        $rules = $newRules;

        // Inline javascript code cleaner.
        if(!in_array('inlinejs', $rules)){
            $str = preg_replace('/(<.+?)(?<=\s)on[a-z]+\s*=\s*(?:([\'"])(?!\2).+?\2|(?:\S+?\(.*?\)(?=[\s>])))(.*?>)/i', "$1$3", $str);
        }

        // Inline css code cleaner.
        if(!in_array('inlinecss', $rules)){
            $str = preg_replace('/(<[^>]*) style=("[^"]+"|\'[^\']+\')([^>]*>)/i', '$1$3', $str);
        }

        // JavaScript tag cleaner.
        if(!in_array('tagjs', $rules)){
            $str = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $str);
        }

        // Css tag cleaner.
        if(!in_array('tagcss', $rules)){
            $str = preg_replace('/<\s*style.+?<\s*\/\s*style.*?>/si', '', $str);
        }

        // iframe code cleaner
        if(!in_array('iframe', $rules)){
            $str = preg_replace('/<iframe.*?\/iframe>/i','', $str);
        }

        return $str;
    }

}
