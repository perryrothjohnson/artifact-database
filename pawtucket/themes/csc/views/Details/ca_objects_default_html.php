<?php
/* ----------------------------------------------------------------------
 * themes/default/views/bundles/ca_objects_default_html.php : 
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013-2015 Whirl-i-Gig
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
 * ----------------------------------------------------------------------
 */
 
	$t_object = 		$this->getVar("item");
	$va_comments = 		$this->getVar("comments");
	$va_tags = 		$this->getVar("tags_array");
	$vn_comments_enabled = 	$this->getVar("commentsEnabled");
	$vn_share_enabled = 	$this->getVar("shareEnabled");

?>
<div class="row">
	<div class='col-xs-12 navTop'><!--- only shown at small screen size -->
		{{{previousLink}}}{{{resultsLink}}}{{{nextLink}}}
	</div><!-- end detailTop -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgLeft">
			{{{previousLink}}}{{{resultsLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
	<div class='col-xs-12 col-sm-10 col-md-10 col-lg-10'>
		<div class="container"><div class="row">
			<div class='col-sm-6 col-md-6 col-lg-5 col-lg-offset-1'>
				{{{representationViewer}}}
				
				
				<div id="detailAnnotations"></div>
				
				<?php print caObjectRepresentationThumbnails($this->request, $this->getVar("representation_id"), $t_object, array("returnAs" => "bsCols", "linkTo" => "carousel", "bsColClasses" => "smallpadding col-sm-3 col-md-3 col-xs-4")); ?>
				
<?php
				# Comment and Share Tools
				if ($vn_comments_enabled | $vn_share_enabled) {
						
					print '<div id="detailTools">';
					if ($vn_comments_enabled) {
?>				
						<div class="detailTool"><a href='#' onclick='jQuery("#detailComments").slideToggle(); return false;'><span class="glyphicon glyphicon-comment"></span>Comments and Tags (<?php print sizeof($va_comments) + sizeof($va_tags); ?>)</a></div><!-- end detailTool -->
						<div id='detailComments'><?php print $this->getVar("itemComments");?></div><!-- end itemComments -->
<?php				
					}
					if ($vn_share_enabled) {
						print '<div class="detailTool"><span class="glyphicon glyphicon-share-alt"></span>'.$this->getVar("shareLink").'</div><!-- end detailTool -->';
					}
					print '</div><!-- end detailTools -->';
				}				
?>
			</div><!-- end col -->
			
			<div class='col-sm-6 col-md-6 col-lg-5'>
				<!-- collection name, object name -->
				<H4>{{{<unit relativeTo="ca_collections" delimiter="<br/>"><l>^ca_collections.preferred_labels.name</l></unit><ifcount min="1" code="ca_collections"> ➔ </ifcount>}}}{{{ca_objects.preferred_labels.name}}}</H4>
				
				<br/><HR><H5>*********************** OBJECT INFO ***********************</H5>

				<!-- supergroup -->
				{{{<ifdef code="ca_objects.supergroup"><HR><H6>Supergroup:</H6>^ca_objects.supergroup<br/></ifdef>}}}

				<!-- installation group -->
				{{{<ifdef code="ca_objects.install_group_var"><HR><H6>Installation group:</H6>
					<unit delimiter="&nbsp;&#10141;&nbsp;">^ca_objects.install_group_var</unit><br/>
				</ifdef>}}}

				<!-- quantity -->
				{{{<ifdef code="ca_objects.extent"><HR><H6>Quantity:</H6>^ca_objects.extent<br/></ifdef>}}}

				<!-- alternate object names -->
				{{{<ifdef code="ca_objects.alternate_object_names"><HR><H6>Alternate object names:</H6>
					<unit delimiter="<br/>">^ca_objects.alternate_object_names</unit>
				</ifdef>}}}

				<!-- notes -->
				{{{<ifdef code="ca_objects.internal_notes"><HR><H6>Notes:</H6>
					<span class="trimText">^ca_objects.internal_notes</span>
				</ifdef>}}}

				<!-- documentation info (for this object) -->
				{{{<ifdef code="ca_objects.documentation_info"><HR><H6>Documentation info (for this object):</H6>
					<span class="trimText">
					<?php
						$names = $t_object->get(
							'ca_objects.documentation_info',
							array("returnAsArray"=>true));
						$links = $t_object->get(
							'ca_objects.documentation_info', 
							array("version"=>"original", "return"=>"url", "returnAsArray"=>true));
						$arrlength = count($names);
						for($x=0; $x<$arrlength; $x++) {
							echo "<a href=" . $links[$x] . " target='_blank'>" . $names[$x] . "</a>";
							echo "<br/>";
						}
					?>
					</span>
				</ifdef>}}}

				<!-- group -->
				{{{<ifdef code="ca_objects.group"><HR><H6>Group [DEPRECATED]:</H6>^ca_objects.group<br/></ifdef>}}}

				<!-- administrative division -->
				{{{<ifdef code="ca_objects.administrative_division"><HR><H6>Administrative division:</H6>^ca_objects.administrative_division<br/></ifdef>}}}
				<!-- category -->
				{{{<ifdef code="ca_objects.object_category"><HR><H6>Category:</H6>^ca_objects.object_category<br/></ifdef>}}}
				<!-- classification -->
				{{{<ifdef code="ca_objects.item_classification"><HR><H6>Classification:</H6>^ca_objects.item_classification<br/></ifdef>}}}

				
				<br/><HR><H5>*********************** ID NUMBERS ***********************</H5>

				<!-- object ID/accession number -->
				{{{<ifdef code="ca_objects.idno"><HR><H6>Object ID number:</H6>^ca_objects.idno<br/></ifdef>}}}
				<!-- accessioned? -->
				{{{<ifdef code="ca_objects.accessioned"><HR><H6>Accessioned?:</H6>^ca_objects.accessioned<br/></ifdef>}}}
				
				<!-- Phase III exhibit code -->
				{{{<ifdef code="ca_objects.phase_3_exhibit_code"><HR><H6>Phase III exhibit code:</H6>^ca_objects.phase_3_exhibit_code<br/></ifdef>}}}
				<!-- part number -->
				{{{<ifdef code="ca_objects.part_number"><HR><H6>Part number:</H6>^ca_objects.part_number<br/></ifdef>}}}
				<!-- serial number -->
				{{{<ifdef code="ca_objects.serial_number"><HR><H6>Serial number:</H6>^ca_objects.serial_number<br/></ifdef>}}}
				<!-- previous ID numbers -->
				{{{<ifdef code="ca_objects.altID"><HR><H6>Previous ID numbers:</H6>
					<span class="trimText">
						<unit delimiter="<br/>">^ca_objects.altID.previous_ID_num (^ca_objects.altID.description_prev_ID_num)</unit>
					</span>
				</ifdef>}}}

				<!-- ITAR status -->
				{{{<ifdef code="ca_objects.itar_status"><HR><H6>ITAR status:</H6>^ca_objects.itar_status<br/></ifdef>}}}
				<!-- ITAR code -->
				{{{<ifdef code="ca_objects.itar_code"><HR><H6>ITAR code:</H6>^ca_objects.itar_code<br/></ifdef>}}}



				<br/><HR><H5>******************** LOCATION ********************</H5>
				
				<!-- storage locations -->
				{{{<ifdef code="ca_storage_locations.hierarchy.preferred_labels.name"><HR><H6>Storage/museum location:</H6>
					<!--<unit delimiter="&nbsp;&#10141;&nbsp;">^ca_storage_locations.hierarchy.preferred_labels.name</unit><br/>-->
					<?php
						$locs = $t_object->get('ca_storage_locations.hierarchy.preferred_labels.name', array("returnAsArray"=>true, "delimiter"=>"&nbsp;&#10141;&nbsp;"));
						$arrlength = count($locs);
						if ($arrlength > 1) {
							echo "<ul>";
							for($x=0; $x<$arrlength; $x++) {
								echo "<li>" . $locs[$x] . "</li>";
							}
							echo "</ul>";
						} else {
							for($x=0; $x<$arrlength; $x++) {
								echo $locs[$x] . "<br/>";
							}
						}
					?>
				</ifdef>}}}

				<!-- on display? -->
				{{{<ifdef code="ca_objects.on_display"><HR><H6>On display?:</H6>^ca_objects.on_display<br/></ifdef>}}}

				<!-- intended gallery location -->
				{{{<ifdef code="ca_objects.intended_gallery_location"><HR><H6>Phase III gallery location:</H6>^ca_objects.intended_gallery_location<br/></ifdef>}}}

				<!-- intended display method -->
				{{{<ifdef code="ca_objects.current_display_method"><HR><H6>Phase III display method:</H6>^ca_objects.current_display_method<br/></ifdef>}}}

				<!-- display notes -->
				{{{<ifdef code="ca_objects.display_notes"><HR><H6>Phase III display notes:</H6>^ca_objects.display_notes<br/></ifdef>}}}


				<br/><HR><H5>******************** DIMENSIONS ********************</H5>

				<!-- dimensions -->
				{{{<ifdef code="ca_objects.length_dimension"><HR><H6>Length (or diameter):</H6>^ca_objects.length_dimension<br/></ifdef>}}}
				{{{<ifdef code="ca_objects.width_dimension"><H6>Width:</H6>^ca_objects.width_dimension<br/></ifdef>}}}
				{{{<ifdef code="ca_objects.height_dimension"><H6>Height (or thickness):</H6>^ca_objects.height_dimension<br/></ifdef>}}}
				{{{<ifdef code="ca_objects.weight_dimension"><H6>Weight:</H6>^ca_objects.weight_dimension<br/></ifdef>}}}



				<HR><H5>******************** ACQUISITION INFO ********************</H5>

				<!-- donor/related entities -->
				{{{<ifdef code="ca_entities.preferred_labels.displayname"><HR><H6>Donor/Lender/Vendor/Transfer party:</H6>
					<?php
						$names = $t_object->get(
							'ca_entities.preferred_labels.displayname', 
							array("returnAsArray"=>true, "restrictToRelationshipTypes"=>array("donor", "lender", "vendor", "trader", "transfer_party")));
						$arrlength = count($names);
						for($x=0; $x<$arrlength; $x++) {
							echo $names[$x];
							echo "<br/>";
						}
					?>
				</ifdef>}}}
				<!-- donor attribution -->
				{{{<ifdef code="ca_objects.donor_attribution"><H6>Donor attribution:</H6>
					<unit delimiter="<br/>">^ca_objects.donor_attribution.donor_attrib_text</unit>
				</ifdef>}}}

				<!-- acquisition method -->
				{{{<ifdef code="ca_object_lots.type_id"><HR><H6>Acquisition method:</H6>^ca_object_lots.type_id<br/></ifdef>}}}
				<!-- object lot ID -->
				{{{<ifdef code="ca_object_lots.preferred_labels"><HR><H6>Object lot ID:</H6>^ca_object_lots.preferred_labels (^ca_object_lots.idno_stub)<br/></ifdef>}}}
				<!-- DGS paid -->
				{{{<ifdef code="ca_object_lots.DGS_paid_lot"><HR><H6>Acquisition method:</H6>^ca_object_lots.DGS_paid_lot<br/></ifdef>}}}
				<!-- loan info -->
				{{{<ifdef code="ca_loans.preferred_labels"><HR><H6>Loan info:</H6>^ca_loans.preferred_labels (loan #^ca_loans.idno)<br/></ifdef>}}}

				<!-- transfer date -->
				{{{<ifdef code="ca_objects.transfer_date"><HR><H6>Transfer date:</H6>^ca_objects.transfer_date<br/></ifdef>}}}
				<!-- delivery date -->
				{{{<ifdef code="ca_objects.delivery_date"><HR><H6>Delivery date:</H6>^ca_objects.delivery_date<br/></ifdef>}}}

				<!-- owned by/loaned to -->
				{{{<ifdef code="ca_objects.owned_by_loaned_to"><HR><H6>Owned by/Loaned to:</H6>^ca_objects.owned_by_loaned_to<br/></ifdef>}}}
				<!-- item value -->
				{{{<ifdef code="ca_objects.item_value"><HR><H6>Object value:</H6>^ca_objects.item_value<br/></ifdef>}}}
				<!-- insurance value -->
				{{{<ifdef code="ca_objects.insurance_value"><HR><H6>Insurance value:</H6>^ca_objects.insurance_value<br/></ifdef>}}}
				<!-- insurance method -->
				{{{<ifdef code="ca_objects.insurance_method"><HR><H6>Insurance method:</H6>^ca_objects.insurance_method<br/></ifdef>}}}

				<!-- documentation info (from object lot) -->
				{{{<ifdef code="ca_object_lots.documentation_info"><HR><H6>Documentation info (from object lot #^ca_object_lots.idno_stub):</H6>
					<span class="trimText">
					<?php
						$names = $t_object->get(
							'ca_object_lots.documentation_info',
							array("returnAsArray"=>true));
						$links = $t_object->get(
							'ca_object_lots.documentation_info',
							array("version"=>"original", "return"=>"url", "returnAsArray"=>true));
						$arrlength = count($names);
						for($x=0; $x<$arrlength; $x++) {
							echo "<a href=" . $links[$x] . " target='_blank'>" . $names[$x] . "</a>";
							echo "<br/>";
						}
					?>
					</span>
				</ifdef>}}}

				<!-- documentation info (from loan) -->
				{{{<ifdef code="ca_loans.documentation_info"><HR><H6>Documentation info (from loan #^ca_loans.idno):</H6>
					<span class="trimText">
					<?php
						$names = $t_object->get(
							'ca_loans.documentation_info',
							array("returnAsArray"=>true));
						$links = $t_object->get(
							'ca_loans.documentation_info',
							array("version"=>"original", "return"=>"url", "returnAsArray"=>true));
						$arrlength = count($names);
						for($x=0; $x<$arrlength; $x++) {
							echo "<a href=" . $links[$x] . " target='_blank'>" . $names[$x] . "</a>";
							echo "<br/>";
						}
					?>
					</span>
				</ifdef>}}}



				<HR><H5>******************** CONSERVATION ********************</H5>

				<!-- condition -->
				{{{<ifdef code="ca_objects.condition"><HR><H6>Condition:</H6>^ca_objects.condition<br/></ifdef>}}}

				<!-- condition report -->
				{{{<ifdef code="ca_objects.condition_report"><HR><H6>Condition report:</H6>
					<span class="trimText">
					<?php
						$names = $t_object->get(
							'ca_objects.condition_report',
							array("returnAsArray"=>true));
						$links = $t_object->get(
							'ca_objects.condition_report',
							array("version"=>"original", "return"=>"url", "returnAsArray"=>true));
						$arrlength = count($names);
						for($x=0; $x<$arrlength; $x++) {
							echo "<a href=" . $links[$x] . " target='_blank'>" . $names[$x] . "</a>";
							echo "<br/>";
						}
					?>
					</span>
				</ifdef>}}}

			

				<!-- object materials -->
				{{{<ifdef code="ca_objects.format_text"><HR><H6>Object materials:</H6>
					<unit delimiter=", ">^ca_objects.format_text</unit>
				</ifdef>}}}

				<!-- MSDS -->
				{{{<ifdef code="ca_objects.msds"><HR><H6>MSDS:</H6>
					<span class="trimText">
					<?php
						$names = $t_object->get(
							'ca_objects.msds',
							array("returnAsArray"=>true));
						$links = $t_object->get(
							'ca_objects.msds',
							array("version"=>"original", "return"=>"url", "returnAsArray"=>true));
						$arrlength = count($names);
						for($x=0; $x<$arrlength; $x++) {
							echo "<a href=" . $links[$x] . " target='_blank'>" . $names[$x] . "</a>";
							echo "<br/>";
						}
					?>
					</span>
				</ifdef>}}}

				<!-- handling and maintenance -->
				{{{<ifdef code="ca_objects.handling_and_maintenance"><HR><H6>Special handling and maintenance instructions:</H6>
					<span class="trimText">^ca_objects.handling_and_maintenance</span>
				</ifdef>}}}



				<HR><H5>******************** RESEARCH ********************</H5>

				<!-- object function -->
				{{{<ifdef code="ca_objects.object_function"><HR><H6>Object function:</H6>
					<span class="trimText">^ca_objects.object_function</span>
				</ifdef>}}}

				<!-- object description -->
				{{{<ifdef code="ca_objects.description"><HR><H6>Object description:</H6>
					<span class="trimText">^ca_objects.description</span>
				</ifdef>}}}

				<!-- historical significance -->
				{{{<ifdef code="ca_objects.historical_significance"><HR><H6>Historical significance:</H6>
					<span class="trimText">^ca_objects.historical_significance</span>
				</ifdef>}}}

				<!-- pedigree -->
				{{{<ifdef code="ca_objects.pedigree"><HR><H6>Pedigree:</H6>
					<span class="trimText">^ca_objects.pedigree</span>
				</ifdef>}}}

				<!-- date of manufacture -->
				{{{<ifdef code="ca_objects.date_manufacture"><HR><H6>Date of manufacture:</H6>^ca_objects.date_manufacture<br/></ifdef>}}}

				<!-- external links -->
				{{{<ifdef code="ca_objects.external_link"><HR><H6>External links:</H6>
					<span class="trimText">
					<?php
						$names = $t_object->get(
							'ca_objects.external_link.url_source',
							array("returnAsArray"=>true));
						$links = $t_object->get(
							'ca_objects.external_link.url_entry',
							array("returnAsArray"=>true));
						$arrlength = count($names);
						for($x=0; $x<$arrlength; $x++) {
							echo "<a href=" . $links[$x] . " target='_blank'>" . $names[$x] . "</a>";
							echo "<br/><br/>";
						}
					?>
					</span>
				</ifdef>}}}


				<HR><H5>******************** RELATED PEOPLE/ORGS ********************</H5>

				<!-- related people -->
				<hr></hr>
					<div class="row">
						<div class="col-sm-6">		
							<!--
							{{{<ifcount code="ca_entities" min="1" max="1"><H6>Related person/organization</H6></ifcount>}}}
							{{{<ifcount code="ca_entities" min="2"><H6>Related people/organizations</H6></ifcount>}}}
							-->
							{{{<unit relativeTo="ca_entities" delimiter="<br/>"><l>^ca_entities.preferred_labels.displayname</l></unit>}}}

							<!--
							{{{<ifcount code="ca_places" min="1" max="1"><H6>Related place</H6></ifcount>}}}
							{{{<ifcount code="ca_places" min="2"><H6>Related places</H6></ifcount>}}}
							{{{<unit relativeTo="ca_places" delimiter="<br/>"><l>^ca_places.preferred_labels.name</l></unit>}}}
							
							{{{<ifcount code="ca_list_items" min="1" max="1"><H6>Related Term</H6></ifcount>}}}
							{{{<ifcount code="ca_list_items" min="2"><H6>Related Terms</H6></ifcount>}}}
							{{{<unit relativeTo="ca_list_items" delimiter="<br/>">^ca_list_items.preferred_labels.name_plural</unit>}}}
							
							{{{<ifcount code="ca_objects.LcshNames" min="1"><H6>LC Terms</H6></ifcount>}}}
							{{{<unit delimiter="<br/>"><l>^ca_objects.LcshNames</l></unit>}}}
							-->
						</div><!-- end col -->				
						<div class="col-sm-6 colBorderLeft">
							{{{map}}}
						</div>
					</div><!-- end row -->
			</div><!-- end col -->
		</div><!-- end row --></div><!-- end container -->
	</div><!-- end col -->
	<div class='navLeftRight col-xs-1 col-sm-1 col-md-1 col-lg-1'>
		<div class="detailNavBgRight">
			{{{nextLink}}}
		</div><!-- end detailNavBgLeft -->
	</div><!-- end col -->
</div><!-- end row -->

<script type='text/javascript'>
	jQuery(document).ready(function() {
		$('.trimText').readmore({
		  speed: 75,
		  maxHeight: 120
		});
	});
</script>
