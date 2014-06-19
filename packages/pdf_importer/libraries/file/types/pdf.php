<?

defined('C5_EXECUTE') or die("Access Denied.");

class PdfFileTypeInspector extends FileTypeInspector {
	
	public function inspect($fv) {
      $path = $fv->getPath();
      if(function_exists('shell_exec')) {
         $th = Loader::helper('text');
         $content = $th->sanitize(`pdftotext {$path} -`);
      }
      $ak = FileAttributeKey::getByHandle('document_content');
      $fv->setAttribute($ak, $content);
   }
}
