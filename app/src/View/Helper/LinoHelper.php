<?php
namespace Cake\View\Helper;

use Cake\View\Helper;

class LinoHelper extends Helper
{
    public function showMultiCmi($cmidoc) {
      echo "<div class='col-xs-12'>";
      echo "  <ul class='article-list'>";
      foreach ($cmidoc['cmi_link_product_documents'] as $doc) {
        echo "  <li><a href='/medicines/cmis/".$cmidoc['full_url']."/".$doc['url']."'>".$doc['description']."</a></li>";
      }
      echo "  </ul>";
      echo "</div>";
	    //return 'cmi links: '. $links;
    }
}
