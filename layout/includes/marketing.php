<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * The Elegance theme is built upon  Bootstrapbase 3 (non-core).
 *
 * @package    theme
 * @subpackage theme_flexibase
 * @author     Richard Oelmann
 * @author     Based on code originally written by Julian (@moodleman) Ridden, G J Bernard, Mary Evans, Bas Brands, Stuart Lamour and David Scotson.
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
 
 $hasmarketing1 = (!empty($PAGE->theme->settings->marketing1));
 if ($hasmarketing1) {
 	$marketing1title = $PAGE->theme->settings->marketing1;
 	$marketing1icon = $PAGE->theme->settings->marketing1icon;
 	$marketing1content = $PAGE->theme->settings->marketing1content;
 }
 
 $hasmarketing2 = (!empty($PAGE->theme->settings->marketing2));
 if ($hasmarketing2) {
 	$marketing2title = $PAGE->theme->settings->marketing2;
 	$marketing2icon = $PAGE->theme->settings->marketing2icon;
 	$marketing2content = $PAGE->theme->settings->marketing2content;
 }
 
 $hasmarketing3 = (!empty($PAGE->theme->settings->marketing3));
 if ($hasmarketing3) {
 	$marketing3title = $PAGE->theme->settings->marketing3;
 	$marketing3icon = $PAGE->theme->settings->marketing3icon;
 	$marketing3content = $PAGE->theme->settings->marketing3content;
 }
 
 $hasmarketing4 = (!empty($PAGE->theme->settings->marketing4));
 if ($hasmarketing4) {
 	$marketing4title = $PAGE->theme->settings->marketing4;
 	$marketing4icon = $PAGE->theme->settings->marketing4icon;
 	$marketing4content = $PAGE->theme->settings->marketing4content;
 }
 
 ?>

	<div id="page-marketing" class="">
<?php /*		<h2 class="marketingheader panel-title header">
			<i class="fa fa-<?php echo $PAGE->theme->settings->marketingtitleicon ?>"></i>
			<?php echo $PAGE->theme->settings->marketingtitle ?>
		</h2>
		*/ ?>
		
		<div class="marketing-wrapper">

			<!-- Start Spot One -->
			<?php if ($hasmarketing1) { ?>
				<div class="marketing-block block panel panel-default">
					<h3 class="panel-title header">
						<i class="fa fa-<?php echo $PAGE->theme->settings->marketing1icon ?>"></i>
						<?php echo $PAGE->theme->settings->marketing1 ?>
					</h3>
					<div class="marketing-block-content">
						<?php echo $PAGE->theme->settings->marketing1content ?>
					</div>
				</div>
			<?php } ?>
			<!-- End Spot One -->
	
			<!-- Start Spot Two -->
			<?php if ($hasmarketing2) { ?>
				<div class="marketing-block block panel panel-default">
					<h3 class="panel-title header">
						<i class="fa fa-<?php echo $PAGE->theme->settings->marketing2icon ?>"></i>
						<?php echo $PAGE->theme->settings->marketing2 ?>
					</h3>
					<div class="marketing-block-content">
						<?php echo $PAGE->theme->settings->marketing2content ?>
					</div>
				</div>
			<?php } ?>
			<!-- End Spot Two -->
						
			<!-- Start Spot Three -->
			<?php if ($hasmarketing3) { ?>
				<div class="marketing-block block panel panel-default">
					<h3 class="panel-title header">
						<i class="fa fa-<?php echo $PAGE->theme->settings->marketing3icon ?>"></i>
						<?php echo $PAGE->theme->settings->marketing3 ?>
					</h3>
					<div class="marketing-block-content">
						<?php echo $PAGE->theme->settings->marketing3content ?>
					</div>
				</div>
			<?php } ?>
			<!-- End Spot Three -->
						
			<!-- Start Spot Four -->
			<?php if ($hasmarketing4) { ?>
				<div class="marketing-block block panel panel-default">
					<h3 class="panel-title header">
						<i class="fa fa-<?php echo $PAGE->theme->settings->marketing4icon ?>"></i>
						<?php echo $PAGE->theme->settings->marketing4 ?>
					</h3>
					<div class="marketing-block-content">
						<?php echo $PAGE->theme->settings->marketing4content ?>
					</div>
				</div>
			<?php } ?>
			<!-- End Spot Four -->

		</div>
	</div>
