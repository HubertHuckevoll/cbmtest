<?php

class searchV extends cbmPageV
{
  /**
   * Summary of drawRandom
   * @return string
   * ________________________________________________________________
   */
  public function cbmContent(): string
  {
    $str = '';
    $entries = $this->get('search', 'results');

    foreach($entries as $entry)
    {
      $str .= '<p><a href="'.$this->renderHrefArticle($entry['article']['articleName']).'">'.$entry['hit'].'</a></p>';
    }

    return $str;
  }

}

?>