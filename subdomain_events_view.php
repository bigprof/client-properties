<?php
// This script and data application were generated by AppGini 23.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/subdomain_events.php');
	include_once(__DIR__ . '/subdomain_events_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('subdomain_events');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'subdomain_events';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`subdomain_events`.`id`" => "id",
		"if(`subdomain_events`.`datetime`,date_format(`subdomain_events`.`datetime`,'%d/%m/%Y %h:%i %p'),'')" => "datetime",
		"IF(    CHAR_LENGTH(`subdomains1`.`subdomain`) || CHAR_LENGTH(`domains1`.`domain_name`), CONCAT_WS('',   `subdomains1`.`subdomain`, '.', `domains1`.`domain_name`), '') /* Subdomain */" => "subdomain",
		"`subdomain_events`.`event`" => "event",
		"`subdomain_events`.`details`" => "details",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`subdomain_events`.`id`',
		2 => '`subdomain_events`.`datetime`',
		3 => 3,
		4 => 4,
		5 => 5,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`subdomain_events`.`id`" => "id",
		"if(`subdomain_events`.`datetime`,date_format(`subdomain_events`.`datetime`,'%d/%m/%Y %h:%i %p'),'')" => "datetime",
		"IF(    CHAR_LENGTH(`subdomains1`.`subdomain`) || CHAR_LENGTH(`domains1`.`domain_name`), CONCAT_WS('',   `subdomains1`.`subdomain`, '.', `domains1`.`domain_name`), '') /* Subdomain */" => "subdomain",
		"`subdomain_events`.`event`" => "event",
		"`subdomain_events`.`details`" => "details",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`subdomain_events`.`id`" => "ID",
		"`subdomain_events`.`datetime`" => "Datetime",
		"IF(    CHAR_LENGTH(`subdomains1`.`subdomain`) || CHAR_LENGTH(`domains1`.`domain_name`), CONCAT_WS('',   `subdomains1`.`subdomain`, '.', `domains1`.`domain_name`), '') /* Subdomain */" => "Subdomain",
		"`subdomain_events`.`event`" => "Event",
		"`subdomain_events`.`details`" => "Details",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`subdomain_events`.`id`" => "id",
		"if(`subdomain_events`.`datetime`,date_format(`subdomain_events`.`datetime`,'%d/%m/%Y %h:%i %p'),'')" => "datetime",
		"IF(    CHAR_LENGTH(`subdomains1`.`subdomain`) || CHAR_LENGTH(`domains1`.`domain_name`), CONCAT_WS('',   `subdomains1`.`subdomain`, '.', `domains1`.`domain_name`), '') /* Subdomain */" => "subdomain",
		"`subdomain_events`.`event`" => "event",
		"`subdomain_events`.`details`" => "details",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['subdomain' => 'Subdomain', ];

	$x->QueryFrom = "`subdomain_events` LEFT JOIN `subdomains` as subdomains1 ON `subdomains1`.`id`=`subdomain_events`.`subdomain` LEFT JOIN `domains` as domains1 ON `domains1`.`domain_name`=`subdomains1`.`domain` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm['view'] == 0 ? 1 : 0);
	$x->AllowDelete = $perm['delete'];
	$x->AllowMassDelete = (getLoggedAdmin() !== false);
	$x->AllowInsert = $perm['insert'];
	$x->AllowUpdate = $perm['edit'];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = (getLoggedAdmin() !== false);
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowPrintingDV = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 25;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation['quick search'];
	$x->ScriptFileName = 'subdomain_events_view.php';
	$x->RedirectAfterInsert = 'subdomain_events_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Subdomain events';
	$x->TableIcon = 'resources/table_icons/file_extension_log.png';
	$x->PrimaryKey = '`subdomain_events`.`id`';
	$x->DefaultSortField = '`subdomain_events`.`datetime`';
	$x->DefaultSortDirection = 'desc';

	$x->ColWidth = [150, 150, 150, 150, ];
	$x->ColCaption = ['Datetime', 'Subdomain', 'Event', 'Details', ];
	$x->ColFieldName = ['datetime', 'subdomain', 'event', 'details', ];
	$x->ColNumber  = [2, 3, 4, 5, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/subdomain_events_templateTV.html';
	$x->SelectedTemplate = 'templates/subdomain_events_templateTVS.html';
	$x->TemplateDV = 'templates/subdomain_events_templateDV.html';
	$x->TemplateDVP = 'templates/subdomain_events_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: subdomain_events_init
	$render = true;
	if(function_exists('subdomain_events_init')) {
		$args = [];
		$render = subdomain_events_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: subdomain_events_header
	$headerCode = '';
	if(function_exists('subdomain_events_header')) {
		$args = [];
		$headerCode = subdomain_events_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: subdomain_events_footer
	$footerCode = '';
	if(function_exists('subdomain_events_footer')) {
		$args = [];
		$footerCode = subdomain_events_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}