<?php defined('C5_EXECUTE') or die('Access Denied');

class PdfImporterPackage extends Package {

    protected $pkgHandle = 'pdf_importer';
    protected $appversionRequired = '5.5';
    protected $pkgVersion = '0.1';

    public function getPackageDescription() {
       return t('Parse PDFs for text on import');
    }
    public function getPackageName() {
       return t('PDF Import');
    }
    public function on_start() {
    	$ft = FileTypeList::getInstance();
		$ft->define('pdf', t('PDF'), FileType::T_DOCUMENT, 'pdf',false,false,'pdf_importer');
		
		// antiword - http://www.winfield.demon.nl/
		//define('BIN_MS_WORD_INSPECTOR', 'path/to/antiword');
		//$ft->define('doc,docx', t('MS Word'), FileType::T_DOCUMENT, 'ms_word',false,false,'pdf_importer');
		
    }

    public function install() {
       $pkg = parent::install();
       Loader::model('file_attributes');
       $attribute = FileAttributeKey::getByHandle('document_content');
       if (!is_object($attribute)) {
          $texta = AttributeType::getByHandle('textarea');
          FileAttributeKey::add($texta, array('akHandle' => 'document_content', 'akName' => t('Document Content'), 'akIsSearchable' => true), $pkg);
       }
    }
}
