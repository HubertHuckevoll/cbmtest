<?php

$cstr = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<cbm>
    <title>Schneeammer</title>
    <header>Schneeammer</header>
    <summary>Schneeammer</summary>
    <content>
<![CDATA[
Ab Mitte der 1770er Jahre ließ der auf Gordon Castle residierende Alexander Gordon, 4. Duke of Gordon die Ortschaft Fochabers in
größerer Entfernung zu seinem Sitz als Plansiedlung neu aufbauen.[2] Die Bellie Kirk sollte hierbei das Herzstück der neuen Ortschaft
bilden. Mit der Planung des Kirchengebäudes wurde John Baxter betraut. Die Bellie Kirk entstand zwischen 1795 und 1798 nach seinen
Entwürfen. In den 1840er Jahren wurde der Innenraum des Gebäudes überarbeitet und neu arrangiert. Letztere Änderungen wurde später
wieder zurückgenommen.

1947 verschmolz die Kirchengemeinde mit der Gemeinde der Pringle Church der United Free Church. Rückwärtig entstand 1985 ein neuer
Gemeindesaal. 1998, ein Jahr nach der 200-Jahrfeier, erhielt die Apsis neue Bleiglasfenster. Eine neue Orgel wurde im Jahre 2007
installiert. Sie ersetzte ein rund 120 Jahre altes Instrument. 2009 wurde die seit mehreren Jahren andauernde Modernisierung des
Innenraums abgeschlossen. 2015 verschmolz die Kirchengemeinde mit der Gemeinde Speymouth. Im Folgejahr wurden umfassende
Instandsetzungsarbeiten am Glockenturm abgeschlossen.
]]>
    </content>
    <images>
        <img title="Schneeammer">schneeammer.png</img>
    </images>
</cbm>
XML;

$hstr = <<<XML
<?xml version="1.0" encoding="UTF-8" ?>
<cbm>
    <version>1</version>
    <title>Schneeammer</title>
    <author>K. Meyer</author>
    <header>Schneeammer</header>
    <summary>Schneeammer</summary>
    <content>
      <html xmlns:html="http://www.w3.org/1999/xhtml">
        <ul>
            <li>
            Ab Mitte der 1770er Jahre ließ der auf Gordon Castle residierende Alexander Gordon, 4. Duke of Gordon die Ortschaft Fochabers in
            größerer Entfernung zu seinem Sitz als Plansiedlung neu aufbauen.[2] Die Bellie Kirk sollte hierbei das Herzstück der neuen Ortschaft
            bilden. Mit der Planung des Kirchengebäudes wurde John Baxter betraut. Die Bellie Kirk entstand zwischen 1795 und 1798 nach seinen
            Entwürfen. In den 1840er Jahren wurde der Innenraum des Gebäudes überarbeitet und neu arrangiert. Letztere Änderungen wurde später
            wieder zurückgenommen.
            </li>
            <li>
            1947 verschmolz die Kirchengemeinde mit der Gemeinde der Pringle Church der United Free Church. Rückwärtig entstand 1985 ein neuer
            Gemeindesaal. 1998, ein Jahr nach der 200-Jahrfeier, erhielt die Apsis neue Bleiglasfenster. Eine neue Orgel wurde im Jahre 2007
            installiert. Sie ersetzte ein rund 120 Jahre altes Instrument. 2009 wurde die seit mehreren Jahren andauernde Modernisierung des
            Innenraums abgeschlossen. 2015 verschmolz die Kirchengemeinde mit der Gemeinde Speymouth. Im Folgejahr wurden umfassende
            Instandsetzungsarbeiten am Glockenturm abgeschlossen.
            </li>
        </ul>
        <div>
            Seattle <strong>Firefighters</strong>.
        </div>
      </html>
    </content>
    <images>
        <img title="Schneeammer">schneeammer.png</img>
        <img title="Schneehammer">schneehammer.png</img>
        <img title="Schneeeule">schneeeule.png</img>
    </images>
</cbm>
XML;


$xml = simplexml_load_string($hstr, null, LIBXML_NOCDATA | LIBXML_NOBLANKS);

$result = [];

foreach($xml->children() as $tagName => $val)
{
  if ($tagName == 'content')
  {
    $nodes = $val->xpath('html/*');

    if ($nodes)
    {
      $result['content'] = '';
      foreach ($nodes as $node)
      {
        $result['content'] .= $node->asXML();
      }
    }
    else
    {
      $result[$tagName] = (string) $val;
    }
  }
  elseif ($tagName == 'images')
  {
    $result['images'] = [];
    foreach($val->children() as $img)
    {
      array_push($result['images'], ['src'=>(string) $img, 'title'=>(string) $img['title']]);
    }
  }
  else
  {
    $result[$tagName] = (string) $val;
  }
}

/*
foreach($xml->images->children() as $img)
{
    echo $img['title'];
    echo "<br>";
}
echo $xml->images->img[1]['title'];


$json = json_encode($xml);
$arr = json_decode($json, true);

$arr['content'] = '';
$nodes = $xml->content->xpath('html/*');

foreach ($nodes as $node)
{
  $arr['content'] .= $node->asXML();
}
*/

$out = '';
$out  = '<pre>';
$out .= print_r($result, true);
//$out .= $xml->images->img[0]['title'];
//$out .= $arr['images']['img'][0]['@attributes'];
$out .= '</pre>';

echo $out;

?>