<?php
/* 
 * LanguageParser reads in a languagefile, which has an array
 * with translations from keys to text. E.G.:
 * $this->text_array['dutch'] = 'Nederlands';
 * 
*/
class LanguageParser 
{
    
    private $langfile = '';
    private $text_array = array();
    
    /* 
     * Constructor function. Loads in the language file, set in config.ini
     */
    public function __construct() 
    {
        $langfile = $GLOBALS['config']['app_root'] . $GLOBALS['config']['language_folder'] . '/' . $GLOBALS['config']['language'] . '.php';
        if (!file_exists($langfile)) {
            throw new Exception('Language file (' . $langfile . ') does not exist. Change language file in config!');
        }
        
        require $langfile;
    }
    
    /**
     * Returns a translated piece of text, from the language file.
     *
     * @param string $id    <The identifier (key) for the text to be translated.>
     * @return string       <Translated text. If not found, returns the key given.>
     */
    public function translate($id) 
    {
        
        if (array_key_exists($id, $this->text_array)) {
            return $this->text_array[$id];
        } else {
            return $id;
        }
    
    }
    
    /**
     * Shorthand version of the translate method.
     *
     * @param string $id    <The identifier (key) for the text to be translated.>
     * @return string       <Translated text. If not found, returns the key given.>
     */
    public function t($id) 
    {
        return $this->translate($id);
    }
    
}