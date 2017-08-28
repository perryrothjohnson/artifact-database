<?php
/* ----------------------------------------------------------------------
 * app/printTemplates/labels/avery_5162.php
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * -=-=-=-=-=- CUT HERE -=-=-=-=-=-
 * Template configuration:
 *
 * @name Avery 5162 1/2 ID tags
 * @type label
 * @pageSize letter
 * @pageOrientation portrait
 * @tables ca_objects
 * @marginLeft 0.125in
 * @marginRight 0.125in
 * @marginTop 0.8125in
 * @marginBottom 0.8125in
 * @horizontalGutter 0in
 * @verticalGutter 0.1875in
 * @labelWidth 1.90625in
 * @labelHeight 1.3333in
 * 
 * ----------------------------------------------------------------------
 */
 
 	$vo_result = $this->getVar('result');	
 ?>
 <div class="smallText" style="position: absolute; left: 0.125in; top: 0.125in; width: 1.65625in; height: 0.1in; overflow: hidden;">
 	{{{^ca_objects.preferred_labels.name}}}
 </div>

 <div class="titleText" style="position: absolute; left: 0.125in; top: 0.25in; width: 1.65625in; height: 0.2in; overflow: hidden;">
 	{{{^ca_objects.idno}}}
 </div>

 <div class="barcode" style="position: absolute; left: 0.07in; top: 0.4in; width: 0.828125in; height: 1in;">
 	{{{barcode:qrcode:2:^ca_objects.idno}}}
 </div>

 <div class="imageTiny" style="position: absolute; left: 0.9in; top: 0.47in; width: 1in; height: 0.7in; overflow: hidden;">
 	<?php print $vo_result->get('ca_object_representations.media.tiny'); ?>
 </div>
 