<?php
// This script and data application were generated by AppGini 23.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/subdomains.php');
	include_once(__DIR__ . '/subdomains_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('subdomains');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'subdomains';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`subdomains`.`id`" => "id",
		"`subdomains`.`subdomain`" => "subdomain",
		"IF(    CHAR_LENGTH(`domains1`.`domain_name`), CONCAT_WS('',   `domains1`.`domain_name`), '') /* Domain */" => "domain",
		"IF(    CHAR_LENGTH(`servers1`.`hostname`), CONCAT_WS('',   `servers1`.`hostname`), '') /* Server */" => "server",
		"`subdomains`.`comments`" => "comments",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`subdomains`.`id`',
		2 => 2,
		3 => '`domains1`.`domain_name`',
		4 => '`servers1`.`hostname`',
		5 => 5,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`subdomains`.`id`" => "id",
		"`subdomains`.`subdomain`" => "subdomain",
		"IF(    CHAR_LENGTH(`domains1`.`domain_name`), CONCAT_WS('',   `domains1`.`domain_name`), '') /* Domain */" => "domain",
		"IF(    CHAR_LENGTH(`servers1`.`hostname`), CONCAT_WS('',   `servers1`.`hostname`), '') /* Server */" => "server",
		"`subdomains`.`comments`" => "comments",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`subdomains`.`id`" => "ID",
		"`subdomains`.`subdomain`" => "Subdomain",
		"IF(    CHAR_LENGTH(`domains1`.`domain_name`), CONCAT_WS('',   `domains1`.`domain_name`), '') /* Domain */" => "Domain",
		"IF(    CHAR_LENGTH(`servers1`.`hostname`), CONCAT_WS('',   `servers1`.`hostname`), '') /* Server */" => "Server",
		"`subdomains`.`comments`" => "Comments",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`subdomains`.`id`" => "id",
		"`subdomains`.`subdomain`" => "subdomain",
		"IF(    CHAR_LENGTH(`domains1`.`domain_name`), CONCAT_WS('',   `domains1`.`domain_name`), '') /* Domain */" => "domain",
		"IF(    CHAR_LENGTH(`servers1`.`hostname`), CONCAT_WS('',   `servers1`.`hostname`), '') /* Server */" => "server",
		"`subdomains`.`comments`" => "comments",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['domain' => 'Domain', 'server' => 'Server', ];

	$x->QueryFrom = "`subdomains` LEFT JOIN `domains` as domains1 ON `domains1`.`domain_name`=`subdomains`.`domain` LEFT JOIN `servers` as servers1 ON `servers1`.`id`=`subdomains`.`server` ";
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
	$x->ScriptFileName = 'subdomains_view.php';
	$x->RedirectAfterInsert = 'subdomains_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Subdomains';
	$x->TableIcon = 'resources/table_icons/domain_template.png';
	$x->PrimaryKey = '`subdomains`.`id`';
	$x->DefaultSortField = '3';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 150, 150, 150, ];
	$x->ColCaption = ['Subdomain', 'Domain', 'Server', 'Comments', ];
	$x->ColFieldName = ['subdomain', 'domain', 'server', 'comments', ];
	$x->ColNumber  = [2, 3, 4, 5, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/subdomains_templateTV.html';
	$x->SelectedTemplate = 'templates/subdomains_templateTVS.html';
	$x->TemplateDV = 'templates/subdomains_templateDV.html';
	$x->TemplateDVP = 'templates/subdomains_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: subdomains_init
	$render = true;
	if(function_exists('subdomains_init')) {
		$args = [];
		$render = subdomains_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: subdomains_header
	$headerCode = '';
	if(function_exists('subdomains_header')) {
		$args = [];
		$headerCode = subdomains_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: subdomains_footer
	$footerCode = '';
	if(function_exists('subdomains_footer')) {
		$args = [];
		$footerCode = subdomains_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
