<?php defined('C5_EXECUTE') or die("Access Denied.");

class MsWordFileTypeInspector extends FileTypeInspector {
   
   public function inspect($fv) {
      $path = $fv->getPath();
      if(function_exists('shell_exec')) {
         $th = Loader::helper('text');
         $bin = BIN_MS_WORD_INSPECTOR;
         $content = $th->sanitize(`{$bin} {$path}`);
      }
      $ak = FileAttributeKey::getByHandle('document_content');
      $fv->setAttribute($ak, $content);
   }
}
