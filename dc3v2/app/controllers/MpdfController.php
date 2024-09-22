<?php

use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Http\Response;

require "mpdf/index.php";

class MpdfController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('MPDF');
        parent::initialize();
        $this->view->gmenu=1;
    }

   

    public function verificarAction()
    {
        $html='
<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
<!--
span.cls_005{font-family:"Century Schoolbook Bold",serif;font-size:27.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
div.cls_005{font-family:"Century Schoolbook Bold",serif;font-size:27.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
span.cls_006{font-family:Times,serif;font-size:18.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_006{font-family:Times,serif;font-size:18.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_007{font-family:Times,serif;font-size:9.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_007{font-family:Times,serif;font-size:9.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
span.cls_003{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
div.cls_003{font-family:Times,serif;font-size:12.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
-->
</style>
<script type="text/javascript" src="4fa431c6-43ad-11ea-a5fd-0cc47a792c0a_id_4fa431c6-43ad-11ea-a5fd-0cc47a792c0a_files/wz_jsgraphics.js"></script>
</head>
<body>
<div style="position:absolute;left:50%;margin-left:-420px;top:0px;width:841px;height:595px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="4fa431c6-43ad-11ea-a5fd-0cc47a792c0a_id_4fa431c6-43ad-11ea-a5fd-0cc47a792c0a_files/background1.jpg" width=841 height=595></div>
<div style="position:absolute;left:363.90px;top:207.59px" class="cls_005"><span class="cls_005">A: Áaaaa Épozos Áá</span></div>
<div style="position:absolute;left:383.67px;top:264.92px" class="cls_006"><span class="cls_006">Por su participación en el Taller</span></div>
<div style="position:absolute;left:436.82px;top:284.76px" class="cls_006"><span class="cls_006">"Telemarketing "</span></div>
<div style="position:absolute;left:337.94px;top:304.60px" class="cls_006"><span class="cls_006">Que se realizó en Ensenada, Baja California.</span></div>
<div style="position:absolute;left:409.41px;top:324.44px" class="cls_006"><span class="cls_006">El 28 de Enero del 2020.</span></div>
<div style="position:absolute;left:430.16px;top:344.29px" class="cls_006"><span class="cls_006">Duración: 8 Horas.</span></div>
<div style="position:absolute;left:127.56px;top:370.56px" class="cls_007"><span class="cls_007">Folio: 3909</span></div>
<div style="position:absolute;left:127.56px;top:379.07px" class="cls_007"><span class="cls_007">29-01-2020</span></div>
<div style="position:absolute;left:299.01px;top:453.37px" class="cls_003"><span class="cls_003">Alejandro Valdés Peña</span></div>
<div style="position:absolute;left:544.65px;top:453.37px" class="cls_003"><span class="cls_003">Lic. Luis Alfonso Manzanilla Dierdorf</span></div>
<div style="position:absolute;left:328.33px;top:473.21px" class="cls_003"><span class="cls_003">Facilitador</span></div>
<div style="position:absolute;left:617.80px;top:473.21px" class="cls_003"><span class="cls_003">Director</span></div>
</div>
<div style="position:absolute;left:50%;margin-left:-420px;top:605px;width:841px;height:595px;border-style:outset;overflow:hidden">
<div style="position:absolute;left:0px;top:0px">
<img src="4fa431c6-43ad-11ea-a5fd-0cc47a792c0a_id_4fa431c6-43ad-11ea-a5fd-0cc47a792c0a_files/background2.jpg" width=841 height=595></div>
<div style="position:absolute;left:321.24px;top:207.59px" class="cls_005"><span class="cls_005">A: Marimar Barranco López</span></div>
<div style="position:absolute;left:383.67px;top:264.92px" class="cls_006"><span class="cls_006">Por su participación en el Taller</span></div>
<div style="position:absolute;left:436.82px;top:284.76px" class="cls_006"><span class="cls_006">"Telemarketing "</span></div>
<div style="position:absolute;left:337.94px;top:304.60px" class="cls_006"><span class="cls_006">Que se realizó en Ensenada, Baja California.</span></div>
<div style="position:absolute;left:409.41px;top:324.44px" class="cls_006"><span class="cls_006">El 28 de Enero del 2020.</span></div>
<div style="position:absolute;left:430.16px;top:344.29px" class="cls_006"><span class="cls_006">Duración: 8 Horas.</span></div>
<div style="position:absolute;left:127.56px;top:370.56px" class="cls_007"><span class="cls_007">Folio: 3910</span></div>
<div style="position:absolute;left:127.56px;top:379.07px" class="cls_007"><span class="cls_007">29-01-2020</span></div>
<div style="position:absolute;left:299.01px;top:453.37px" class="cls_003"><span class="cls_003">Alejandro Valdés Peña</span></div>
<div style="position:absolute;left:544.65px;top:453.37px" class="cls_003"><span class="cls_003">Lic. Luis Alfonso Manzanilla Dierdorf</span></div>
<div style="position:absolute;left:328.33px;top:473.21px" class="cls_003"><span class="cls_003">Facilitador</span></div>
<div style="position:absolute;left:617.80px;top:473.21px" class="cls_003"><span class="cls_003">Director</span></div>
</div>

</body>
</html>
';   
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $mpdf = new mPDF();
        // $mpdf->SetImportUse();
        // $pagecount = $mpdf->SetSourceFile('mpdf/doc.pdf');
        // $tplId = $mpdf->ImportPage($pagecount);
        // $mpdf->UseTemplate($tplId);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);

        $mpdf->Output();
		// $mpdf->WriteHTML($html);
		// $mpdf->Output();
    }

    public function ejemploAction()
    {
        $html = '
<h1>mPDF</h1>
<h2>Tables</h2>
<h3>CSS Styles</h3>
<p>The CSS properties for tables and cells is increased over that in html2fpdf. It includes recognition of THEAD, TFOOT and TH.<br />See below for other facilities such as autosizing, and rotation.</p>
<table border="1">
<tbody><tr><td>Row 1</td><td>This is data</td><td>This is data</td></tr>
<tr><td>Row 2</td>
<td style="background-gradient: linear #c7cdde #f0f2ff 0 1 0 0.5;">
<p>This is data p</p>
This is data out of p
<p style="font-weight:bold; font-size:20pt; background-color:#FFBBFF;">This is bold data p</p>
<b>This is bold data out of p</b><br />
This is normal data after br
<h3>H3 in a table</h3>
<div>This is data div</div>
This is data out of div
<div style="font-weight:bold;">This is data div (bold)</div>
This is data out of div
</td>
<td><p>More data</p><p style="font-size:12pt;">This is large text</p></td></tr>
<tr><td><p>Row 3</p></td><td><p>This is long data</p></td><td>This is data</td></tr>
<tr><td><p>Row 4 &lt;td&gt; cell</p></td><td>This is data</td><td><p>This is data</p></td></tr>
<tr><td>Row 5</td><td>Also data</td><td>Also data</td></tr>
<tr><td>Row 6</td><td>Also data</td><td>Also data</td></tr>
<tr><td>Row 7</td><td>Also data</td><td>Also data</td></tr>
<tr><td>Row 8</td><td>Also data</td><td>Also data</td></tr>
</tbody></table>
<p>This table has padding-left and -right set to 5mm i.e. padding within the cells. Also border colour and style, font family and size are set by <acronym>CSS</acronym>.</p>
<table align="right" style="border: 1px solid #880000; font-family: Mono; font-size: 7pt; " class="widecells">
<tbody><tr><td>Row 1</td><td>This is data</td><td>This is data</td></tr>
<tr><td>Row 2</td><td><p>This is data p</p></td><td><p>More data</p></td></tr>
<tr><td><p>Row 3</p></td><td><p>This is long data</p></td><td>This is data</td></tr>
<tr><td><p>Row 4 &lt;td&gt; cell</p></td><td>This is data</td><td><p>This is data</p></td></tr>
<tr><td>Row 5</td><td>Also data</td><td>Also data</td></tr>
<tr><td>Row 6</td><td>Also data</td><td>Also data</td></tr>
<tr><td>Row 7</td><td>Also data</td><td>Also data</td></tr>
<tr><td>Row 8</td><td>Also data</td><td>Also data</td></tr>
</tbody></table>
<p>This table has padding-top and -bottom set to 3mm i.e. padding within the cells. Also background-, border colour and style, font family and size are set by in-line <acronym>CSS</acronym>.</p>
<table style="border: 1px solid #880000; background-color: #BBCCDD; font-family: Mono; font-size: 7pt; " class="tallcells">
<tbody><tr><td>Row 1</td><td>This is data</td><td>This is data</td></tr>
<tr><td>Row 2</td><td><p>This is data p</p></td><td><p>More data</p></td></tr>
<tr><td><p>Row 3</p></td><td><p>This is long data</p></td><td>This is data</td></tr>
</tbody></table>
<h3 style="margin-top: 20pt; margin-collapse:collapse;">Table Styles</h3>
<p>The style sheet used for these examples shows some of the table styles I use on my website. The property \'topntail\' defined by a border-type definition e.g. "1px solid #880000" puts a border at the top and bottom of the table, and also below a header row (thead) if defined. Note also that &lt;thead&gt; will automatically turn on the header-repeat i.e. reproduce the header row at the top of each page.</p>
<p>bpmTopic Class</p>
<table class="bpmTopic"><thead></thead><tbody>
<tr>
<td>Row 1</td>
<td>This is data</td>
<td>This is data</td>
</tr>
<tr>
<td>Row 2</td>
<td>
<p>This is data p</p>
</td>
<td>
<p>More data</p>
</td>
</tr>
<tr>
<td>
<p>Row 3</p>
</td>
<td>
<p>This is long data</p>
</td>
<td>This is data</td>
</tr>
<tr>
<td>
<p>Row 4 &lt;td&gt; cell</p>
</td>
<td>This is data</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr>
<td>Row 5</td>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr>
<td>Row 6</td>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr>
<td>Row 7</td>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr>
<td>Row 8</td>
<td>Also data</td>
<td>Also data</td>
</tr>
</tbody></table>
<p>&nbsp;</p>
<p>bpmTopic<b>C</b> Class (centered) Odd and Even rows</p>
<table class="bpmTopicC"><thead>
<tr class="headerrow"><th>Col/Row Header</th>
<td>
<p>Second column header p</p>
</td>
<td>Third column header</td>
</tr>
</thead><tbody>
<tr class="oddrow"><th>Row header 1</th>
<td>This is data</td>
<td>This is data</td>
</tr>
<tr class="evenrow"><th>Row header 2</th>
<td>
<p>This is data p</p>
</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr class="oddrow"><th>
<p>Row header 3</p>
</th>
<td>
<p>This is long data</p>
</td>
<td>This is data</td>
</tr>
<tr class="evenrow"><th>
<p>Row header 4</p>
<p>&lt;th&gt; cell acting as header</p>
</th>
<td>This is data</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr class="oddrow"><th>Row header 5</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr class="evenrow"><th>Row header 6</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr class="oddrow"><th>Row header 7</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr class="evenrow"><th>Row header 8</th>
<td>Also data</td>
<td>Also data</td>
</tr>
</tbody></table>
<p>&nbsp;</p>
<p>bpmTopnTail Class </p>
<table class="bpmTopnTail"><thead></thead><tbody>
<tr>
<td>Row 1</td>
<td>This is data</td>
<td>This is data</td>
</tr>
<tr>
<td>Row 2</td>
<td>
<p>This is data p</p>
</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr>
<td>
<p>Row 3</p>
</td>
<td>
<p>This is long data</p>
</td>
<td>This is data</td>
</tr>
<tr>
<td>
<p>Row 4 &lt;td&gt; cell</p>
</td>
<td>This is data</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr>
<td>Row 5</td>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr>
<td>Row 6</td>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr>
<td>Row 7</td>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr>
<td>Row 8</td>
<td>Also data</td>
<td>Also data</td>
</tr>
</tbody></table>
<p>&nbsp;</p>
<p>bpmTopnTail<b>C</b> Class (centered) Odd and Even rows</p>
<table class="bpmTopnTailC"><thead>
<tr class="headerrow"><th>Col/Row Header</th>
<td>
<p>Second column header p</p>
</td>
<td>Third column header</td>
</tr>
</thead><tbody>
<tr class="oddrow"><th>Row header 1</th>
<td>This is data</td>
<td>This is data</td>
</tr>
<tr class="evenrow"><th>Row header 2</th>
<td>
<p>This is data p</p>
</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr class="oddrow"><th>
<p>Row header 3</p>
</th>
<td>
<p>This is long data</p>
</td>
<td>This is data</td>
</tr>
<tr class="evenrow"><th>
<p>Row header 4</p>
<p>&lt;th&gt; cell acting as header</p>
</th>
<td>This is data</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr class="oddrow"><th>Row header 5</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr class="evenrow"><th>Row header 6</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr class="oddrow"><th>Row header 7</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr class="evenrow"><th>Row header 8</th>
<td>Also data</td>
<td>Also data</td>
</tr>
</tbody></table>
<p>&nbsp;</p>
<p>TopnTail Class</p>
<table class="bpmTopnTail"><thead>
<tr class="headerrow"><th>Col and Row Header</th>
<td>
<p>Second</p>
<p>column</p>
</td>
<td class="pmhTopRight">Top right align</td>
</tr>
</thead><tbody>
<tr class="oddrow"><th>
<p>Row header 1 p</p>
</th>
<td>This is data</td>
<td>This is data</td>
</tr>
<tr class="evenrow"><th>Row header 2</th>
<td class="pmhBottomRight"><b><i>Bottom right align</i></b></td>
<td>
<p>This is data. Can use</p>
<p><b>bold</b> <i>italic </i><sub>sub</sub> or <sup>sup</sup> text</p>
</td>
</tr>
<tr class="oddrow"><th class="pmhBottomRight">
<p>Bottom right align</p>
</th>
<td class="pmhMiddleCenter" style="border: #000000 1px solid">
<p>This is data. This cell</p>
<p>uses Cell Styles to set</p>
<p>the borders.</p>
<p>All borders are collapsible</p>
<p>in mPDF.</p>
</td>
<td>This is data</td>
</tr>
<tr class="evenrow"><th>Row header 4</th>
<td>
<p>This is data p</p>
</td>
<td>More data</td>
</tr>
<tr class="oddrow"><th>Row header 5</th>
<td colspan="2" class="pmhTopCenter">Also data merged and centered</td>
</tr>
</tbody></table>
<p>&nbsp;</p>
<h4>Lists in a Table</h4>
<table class="bpmTopnTail"><thead>
<tr class="headerrow"><th>Col and Row Header</th>
<td>
<p>Second</p>
<p>column</p>
</td>
<td class="pmhTopRight">Top right align</td>
</tr>
</thead><tbody>
<tr class="oddrow"><th>
<p>Row header 1 p</p>
</th>
<td>This is data</td>
<td>This is data</td>
</tr>
<tr class="evenrow"><th>Row header 2</th>
<td>
<ol>
<li>Item 1</li>
<li>Item 2
<ol type="a">
<li>Subitem of ordered list</li>
<li>Subitem 2
<ol type="i">
<li>Level 3 subitem</li>
<li>Level 3 subitem</li>
</ol>
</li>
</ol>
</li>
<li>Item 3</li>
<li>Another Item</li>
<li>Subitem
<ol>
<li>Level 3 subitem</li>
</ol>
</li>
<li>Another Item</li>
</ol>
</td>
<td>
Unordered list:
<ul>
<li>Item 1</li>
<li>Item 2
<ul>
<li>Subitem of unordered list</li>
<li>Subitem 2
<ul>
<li>Level 3 subitem</li>
<li>Level 3 subitem</li>
<li>Level 3 subitem</li>
</ul>
</li>
</ul>
</li>
<li>Item 3</li>
</ul>
</td>
</tr>
</tbody></table>
<p>&nbsp;</p>
<h4>Automatic Column Width</h4>
<table class="bpmTopnTail"><tbody>
<tr>
<td>Causes</td>
<td>Nulla felis erat, imperdiet eu, ullamcorper non, nonummy quis, elit. <br />
Ut a eros at ligula vehicula pretium; maecenas feugiat pede vel risus.<br />
Suspendisse potenti</td>
</tr>
<tr>
<td>Mechanisms</td>
<td>Ut magna ipsum, tempus in, condimentum at, rutrum et, nisl. Vestibulum interdum luctus sapien. Quisque viverra. Etiam id libero at magna pellentesque aliquet. Nulla sit amet ipsum id enim tempus dictum. Maecenas consectetuer eros quis massa. Mauris semper velit vehicula purus. Duis lacus. Aenean pretium consectetuer mauris. Ut purus sem, consequat ut, fermentum sit amet, ornare sit amet, ipsum. Donec non nunc. Maecenas fringilla. Curabitur libero. In dui massa, malesuada sit amet, hendrerit vitae, viverra nec, tortor. Donec varius. Ut ut dolor et tellus adipiscing adipiscing.</td>
</tr>
</tbody></table>
<h4>ColSpan & Rowspan</h4>
<table class="bpmTopnTail"><tbody>
<tr>
<td rowspan="2">Causes</td>
<td colspan="2">Nulla felis erat, imperdiet eu, ullamcorper non, nonummy quis, elit. <br />
Ut a eros at ligula vehicula pretium; maecenas feugiat pede vel risus.<br />
Suspendisse potenti</td>
</tr>
<tr>
<td>Fusce eleifend neque sit amet erat.<br />
Donec mattis, nisi id euismod auctor, neque metus pellentesque risus, at eleifend lacus sapien et risus.</td>
<td>Mauris ante pede, auctor ac, suscipit quis, malesuada sed, nulla.<br />
Phasellus feugiat, lectus ac aliquam molestie, leo lacus tincidunt turpis, vel aliquam quam odio et sapien.</td>
</tr>
</tbody></table>
<h4>Table Header & Footer Rows</h4>
<p>A table using a header row should repeat the header row across pages:</p>
<p>bpmTopic<b>C</b> Class</p>
<table class="bpmTopicC">
<thead>
<tr class="headerrow"><th>Col and Row Header</th>
<td>
<p>Second column header</p>
</td>
<td>Third column header</td>
</tr>
</thead>
<tfoot>
<tr class="footerrow"><th>Col and Row Footer</th>
<td>
<p>Second column footer</p>
</td>
<td>Third column footer</td>
</tr>
</tfoot>
<tbody>
<tr><th>Row header 1</th>
<td>This is data</td>
<td>This is data</td>
</tr>
<tr><th>Row header 2</th>
<td>This is data</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr><th>
<p>Row header 3</p>
</th>
<td>
<p>This is data</p>
</td>
<td>This is data</td>
</tr>
<tr><th>Row header 4</th>
<td>This is data</td>
<td>
<p>This is data</p>
</td>
</tr>
<tr><th>Row header 5</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr><th>Row header 6</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr><th>Row header 7</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr><th>Row header 8</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr><th>Row header 9</th>
<td>Also data</td>
<td>Also data</td>
</tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
<tr><th>Another Row header</th><td>Also data</td><td>Also data</td></tr>
</tbody></table>
<p>&nbsp;</p>
<h3>Autosizing Tables</h3>
<p>Periodic Table of elements. Tables are set by default to reduce font size if complete words will not fit inside each cell, to a maximum of 1/1.4 * the set font-size. This value can be changed by setting $mpdf->shrink_tables_to_fit=1.8 or using html attribute &lt;table autosize="1.8"&gt;.</p>
<h5>Periodic Table</h5>
<table style="border:1px solid #000000;" cellPadding="9"><thead>
<tr><th>1A</th><th>2A</th><th>3B</th><th>4B</th><th>5B</th><th>6B</th><th>7B</th><th>8B</th><th>8B</th><th>8B</th><th>1B</th><th>2B</th><th>3A</th><th>4A</th><th>5A</th><th>6A</th><th>7A</th><th>8A</th></tr></thead><tbody>
<tr>
<td colspan="18"></td>
</tr>
<tr>
<td>H </td>
<td colspan="16"></td>
<td>He </td>
</tr>
<tr>
<td>Li </td>
<td>Be </td>
<td colspan="10"></td>
<td>B </td>
<td>C </td>
<td>N </td>
<td>O </td>
<td>F </td>
<td>Ne </td>
</tr>
<tr>
<td>Na </td>
<td>Mg </td>
<td colspan="10"></td>
<td>Al </td>
<td>Si </td>
<td>P </td>
<td>S </td>
<td>Cl </td>
<td>Ar </td>
</tr>
<tr>
<td>K </td>
<td>Ca </td>
<td>Sc </td>
<td>Ti </td>
<td>V </td>
<td>Cr </td>
<td>Mn </td>
<td>Fe </td>
<td>Co </td>
<td>Ni </td>
<td>Cu </td>
<td>Zn </td>
<td>Ga </td>
<td>Ge </td>
<td>As </td>
<td>Se </td>
<td>Br </td>
<td>Kr </td>
</tr>
<tr>
<td>Rb </td>
<td>Sr </td>
<td>Y </td>
<td>Zr </td>
<td>Nb </td>
<td>Mo </td>
<td>Tc </td>
<td>Ru </td>
<td>Rh </td>
<td>Pd </td>
<td>Ag </td>
<td>Cd </td>
<td>In </td>
<td>Sn </td>
<td>Sb </td>
<td>Te </td>
<td>I </td>
<td>Xe </td>
</tr>
<tr>
<td>Cs </td>
<td>Ba </td>
<td>La </td>
<td>Hf </td>
<td>Ta </td>
<td>W </td>
<td>Re </td>
<td>Os </td>
<td>Ir </td>
<td>Pt </td>
<td>Au </td>
<td>Hg </td>
<td>Tl </td>
<td>Pb </td>
<td>Bi </td>
<td>Po </td>
<td>At </td>
<td>Rn </td>
</tr>
<tr>
<td>Fr </td>
<td>Ra </td>
<td>Ac </td>
<td colspan="15"></td>
</tr>
<tr>
<td colspan="18"></td>
</tr>
<tr>
<td colspan="3"></td>
<td>Ce </td>
<td>Pr </td>
<td>Nd </td>
<td>Pm </td>
<td>Sm </td>
<td>Eu </td>
<td>Gd </td>
<td>Tb </td>
<td>Dy </td>
<td>Ho </td>
<td>Er </td>
<td>Tm </td>
<td>Yb </td>
<td>Lu </td>
<td></td>
</tr>
<tr>
<td colspan="3"></td>
<td>Th </td>
<td>Pa </td>
<td>U </td>
<td>Np </td>
<td>Pu </td>
<td>Am </td>
<td>Cm </td>
<td>Bk </td>
<td>Cf </td>
<td>Es </td>
<td>Fm </td>
<td>Md </td>
<td>No </td>
<td>Lr </td>
<td></td>
</tr>
</tbody></table>
<pagebreak />
<h3>Rotating Tables</h3>
<p>This is set to rotate -90 degrees (counterclockwise).</p>
<h5>Periodic Table</h5>
<p>
<table rotate="-90" class="bpmClearC"><thead>
<tr><th>1A</th><th>2A</th><th>3B</th><th>4B</th><th>5B</th><th>6B</th><th>7B</th><th>8B</th><th>8B</th><th>8B</th><th>1B</th><th>2B</th><th>3A</th><th>4A</th><th>5A</th><th>6A</th><th>7A</th><th>8A</th></tr></thead><tbody>
<tr>
<td></td>
<td colspan="18"></td>
</tr>
<tr>
<td>H </td>
<td colspan="15"></td>
<td></td>
<td>He </td>
</tr>
<tr>
<td>Li </td>
<td>Be </td>
<td colspan="10"></td>
<td>B </td>
<td>C </td>
<td>N </td>
<td>O </td>
<td>F </td>
<td>Ne </td>
</tr>
<tr>
<td>Na </td>
<td>Mg </td>
<td colspan="10"></td>
<td>Al </td>
<td>Si </td>
<td>P </td>
<td>S </td>
<td>Cl </td>
<td>Ar </td>
</tr>
<tr>
<td>K </td>
<td>Ca </td>
<td>Sc </td>
<td>Ti </td>
<td>V </td>
<td>Cr </td>
<td>Mn </td>
<td>Fe </td>
<td>Co </td>
<td>Ni </td>
<td>Cu </td>
<td>Zn </td>
<td>Ga </td>
<td>Ge </td>
<td>As </td>
<td>Se </td>
<td>Br </td>
<td>Kr </td>
</tr>
<tr>
<td>Rb </td>
<td>Sr </td>
<td>Y </td>
<td>Zr </td>
<td>Nb </td>
<td>Mo </td>
<td>Tc </td>
<td>Ru </td>
<td>Rh </td>
<td>Pd </td>
<td>Ag </td>
<td>Cd </td>
<td>In </td>
<td>Sn </td>
<td>Sb </td>
<td>Te </td>
<td>I </td>
<td>Xe </td>
</tr>
<tr>
<td>Cs </td>
<td>Ba </td>
<td>La </td>
<td>Hf </td>
<td>Ta </td>
<td>W </td>
<td>Re </td>
<td>Os </td>
<td>Ir </td>
<td>Pt </td>
<td>Au </td>
<td>Hg </td>
<td>Tl </td>
<td>Pb </td>
<td>Bi </td>
<td>Po </td>
<td>At </td>
<td>Rn </td>
</tr>
<tr>
<td>Fr </td>
<td>Ra </td>
<td>Ac </td>
</tr>
<tr>
<td></td>
<td colspan="18"></td>
</tr>
<tr>
<td colspan="3"></td>
<td>Ce </td>
<td>Pr </td>
<td>Nd </td>
<td>Pm </td>
<td>Sm </td>
<td>Eu </td>
<td>Gd </td>
<td>Tb </td>
<td>Dy </td>
<td>Ho </td>
<td>Er </td>
<td>Tm </td>
<td>Yb </td>
<td>Lu </td>
<td></td>
</tr>
<tr>
<td colspan="3"></td>
<td>Th </td>
<td>Pa </td>
<td>U </td>
<td>Np </td>
<td>Pu </td>
<td>Am </td>
<td>Cm </td>
<td>Bk </td>
<td>Cf </td>
<td>Es </td>
<td>Fm </td>
<td>Md </td>
<td>No </td>
<td>Lr </td>
<td></td>
</tr>
</tbody></table>
<p>&nbsp;</p>
<pagebreak />
<h3>Rotated text in Table Cells</h3>
<h5>Periodic Table</h5>
<table>
<thead>
<tr text-rotate="45">
<th><p>Element type 1A</p><p>Second line</p><th><p>Element type longer 2A</p></th>
<th>Element type 3B</th>
<th>Element type 4B</th>
<th>Element type 5B</th>
<th>Element type 6B</th>
<th>7B</th><th>8B</th>
<th>Element type 8B R</th>
<th>8B</th>
<th>Element <span>type</span> 1B</th>
<th>2B</th>
<th>Element type 3A</th>
<th>Element type 4A</th>
<th>Element type 5A</th>
<th>Element type 6A</th>
<th>7A</th>
<th>Element type 8A</th>
</tr>
</thead>
<tbody>
<tr>
<td>H</td>
<td colspan="15"></td>
<td></td>
<td>He </td>
</tr>
<tr>
<td>Li </td>
<td>Be </td>
<td colspan="10"></td>
<td>B </td>
<td>C </td>
<td>N </td>
<td>O </td>
<td>F </td>
<td>Ne </td>
</tr>
<tr>
<td>Na </td>
<td>Mg </td>
<td colspan="10"></td>
<td>Al </td>
<td>Si </td>
<td>P </td>
<td>S </td>
<td>Cl </td>
<td>Ar </td>
</tr>
<tr style="text-rotate: 45">
<td>K </td>
<td>Ca </td>
<td>Sc </td>
<td>Ti</td>
<td>Va</td>
<td>Cr</td>
<td>Mn</td>
<td>Fe</td>
<td>Co</td>
<td>Ni </td>
<td>Cu </td>
<td>Zn </td>
<td>Ga </td>
<td>Ge </td>
<td>As </td>
<td>Se </td>
<td>Br </td>
<td>Kr </td>
</tr>
<tr>
<td>Rb </td>
<td>Sr </td>
<td>Y </td>
<td>Zr </td>
<td>Nb </td>
<td>Mo </td>
<td>Tc </td>
<td>Ru </td>
<td style="text-align:right; ">Rh</td>
<td>Pd </td>
<td>Ag </td>
<td>Cd </td>
<td>In </td>
<td>Sn </td>
<td>Sb </td>
<td>Te </td>
<td>I </td>
<td>Xe </td>
</tr>
<tr>
<td>Cs </td>
<td>Ba </td>
<td>La </td>
<td>Hf </td>
<td>Ta </td>
<td>W </td>
<td>Re </td>
<td>Os </td>
<td>Ir </td>
<td>Pt </td>
<td>Au </td>
<td>Hg </td>
<td>Tl </td>
<td>Pb </td>
<td>Bi </td>
<td>Po </td>
<td>At </td>
<td>Rn </td>
</tr>
<tr>
<td>Fr </td>
<td>Ra </td>
<td colspan="16">Ac </td>
</tr>
<tr>
<td colspan="3"></td>
<td>Ce </td>
<td>Pr </td>
<td>Nd </td>
<td>Pm </td>
<td>Sm </td>
<td>Eu </td>
<td>Gd </td>
<td>Tb </td>
<td>Dy </td>
<td>Ho </td>
<td>Er </td>
<td>Tm </td>
<td>Yb </td>
<td>Lu </td>
<td></td>
</tr>
<tr>
<td colspan="3"></td>
<td>Th </td>
<td>Pa </td>
<td>U </td>
<td>Np </td>
<td>Pu </td>
<td>Am </td>
<td>Cm </td>
<td>Bk </td>
<td>Cf </td>
<td>Es </td>
<td>Fm </td>
<td>Md </td>
<td>No </td>
<td>Lr </td>
<td></td>
</tr>
</tbody></table>
<p>&nbsp;</p>';

// $path = (getenv('MPDF_ROOT')) ? getenv('MPDF_ROOT') : __DIR__;
// require_once $path . '/vendor/autoload.php';

$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        $mpdf = new mPDF();
        // $mpdf->SetImportUse();
        // $pagecount = $mpdf->SetSourceFile('mpdf/doc.pdf');
        // $tplId = $mpdf->ImportPage($pagecount);
        // $mpdf->UseTemplate($tplId);
        $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        // $mpdf->AddPage('L');
        $mpdf->WriteHTML($html);
        // $mpdf->SetProtection(array(), 'UserPassword', 'MyPassword');

        $mpdf->Output();
    }

    
    
}
