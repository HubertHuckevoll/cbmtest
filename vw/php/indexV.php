<?php

class indexV extends cbmV
{

  public function cBase()
  {
    return $this->renderBaseTag();
  }

  public function cTitle()
  {
    $str  = '';
    $str = $_SERVER['SERVER_NAME'];
    return $str;
  }

  public function cHeader()
  {
    $str  = '';
    $str = $_SERVER['SERVER_NAME'];
    return $str;
  }

  public function cContent()
  {
    $html  = '';
    $articles = $this->get('articles');

    if ($articles !== null)
    {
      $html .= '<ul>';
      foreach($articles as $item)
      {
        $html .= '<li>'.
                   '<a href="'.$this->renderHrefArticle($item['articleName']).'">'.$item['title'].'</a>'.
                   '<p>'.$item['summary'].'</p>'.
                 '</li>';
      }
      $html .= '</ul>';
    }

    return $html;
  }

  public function cPages()
  {
    $html  = '';
    $html .= '<hr>';

    $page = $this->get('index', 'page');
    $maxPage = $this->get('index', 'maxPage');

    for ($i = 0; $i < $maxPage; $i++)
    {
      if ($i == $page)
      {
        $html .= '<span>'.($i+1).'</span>&nbsp;';
      }
      else
      {

        $html .= '<a href="'.$this->renderHrefIndex($i).'"><span>'.($i+1).'</span></a>&nbsp;';
      }
    }

    return $html;
  }
}

?>