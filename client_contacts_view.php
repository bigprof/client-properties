<?php
// This script and data application were generated by AppGini 23.13
// Download AppGini for free from https://bigprof.com/appgini/download/

	include_once(__DIR__ . '/lib.php');
	@include_once(__DIR__ . '/hooks/client_contacts.php');
	include_once(__DIR__ . '/client_contacts_dml.php');

	// mm: can the current member access this page?
	$perm = getTablePermissions('client_contacts');
	if(!$perm['access']) {
		echo error_message($Translation['tableAccessDenied']);
		exit;
	}

	$x = new DataList;
	$x->TableName = 'client_contacts';

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = [
		"`client_contacts`.`id`" => "id",
		"IF(    CHAR_LENGTH(`clients1`.`client`), CONCAT_WS('',   `clients1`.`client`), '') /* Client */" => "client",
		"`client_contacts`.`first_name`" => "first_name",
		"`client_contacts`.`last_name`" => "last_name",
		"`client_contacts`.`title`" => "title",
		"`client_contacts`.`mobile`" => "mobile",
		"`client_contacts`.`work_phone`" => "work_phone",
		"`client_contacts`.`email`" => "email",
		"`client_contacts`.`comments`" => "comments",
	];
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = [
		1 => '`client_contacts`.`id`',
		2 => '`clients1`.`client`',
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9,
	];

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = [
		"`client_contacts`.`id`" => "id",
		"IF(    CHAR_LENGTH(`clients1`.`client`), CONCAT_WS('',   `clients1`.`client`), '') /* Client */" => "client",
		"`client_contacts`.`first_name`" => "first_name",
		"`client_contacts`.`last_name`" => "last_name",
		"`client_contacts`.`title`" => "title",
		"`client_contacts`.`mobile`" => "mobile",
		"`client_contacts`.`work_phone`" => "work_phone",
		"`client_contacts`.`email`" => "email",
		"`client_contacts`.`comments`" => "comments",
	];
	// Fields that can be filtered
	$x->QueryFieldsFilters = [
		"`client_contacts`.`id`" => "ID",
		"IF(    CHAR_LENGTH(`clients1`.`client`), CONCAT_WS('',   `clients1`.`client`), '') /* Client */" => "Client",
		"`client_contacts`.`first_name`" => "First name",
		"`client_contacts`.`last_name`" => "Last name",
		"`client_contacts`.`title`" => "Title",
		"`client_contacts`.`mobile`" => "Mobile/Cellular",
		"`client_contacts`.`work_phone`" => "Work phone",
		"`client_contacts`.`email`" => "Email",
		"`client_contacts`.`comments`" => "Comments",
	];

	// Fields that can be quick searched
	$x->QueryFieldsQS = [
		"`client_contacts`.`id`" => "id",
		"IF(    CHAR_LENGTH(`clients1`.`client`), CONCAT_WS('',   `clients1`.`client`), '') /* Client */" => "client",
		"`client_contacts`.`first_name`" => "first_name",
		"`client_contacts`.`last_name`" => "last_name",
		"`client_contacts`.`title`" => "title",
		"`client_contacts`.`mobile`" => "mobile",
		"`client_contacts`.`work_phone`" => "work_phone",
		"`client_contacts`.`email`" => "email",
		"`client_contacts`.`comments`" => "comments",
	];

	// Lookup fields that can be used as filterers
	$x->filterers = ['client' => 'Client', ];

	$x->QueryFrom = "`client_contacts` LEFT JOIN `clients` as clients1 ON `clients1`.`id`=`client_contacts`.`client` ";
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
	$x->ScriptFileName = 'client_contacts_view.php';
	$x->RedirectAfterInsert = 'client_contacts_view.php?SelectedID=#ID#';
	$x->TableTitle = 'Client contacts';
	$x->TableIcon = 'resources/table_icons/user_comment.png';
	$x->PrimaryKey = '`client_contacts`.`id`';
	$x->DefaultSortField = '2';
	$x->DefaultSortDirection = 'asc';

	$x->ColWidth = [150, 150, 150, 150, 150, 150, 150, 150, ];
	$x->ColCaption = ['Client', 'First name', 'Last name', 'Title', 'Mobile/Cellular', 'Work phone', 'Email', 'Comments', ];
	$x->ColFieldName = ['client', 'first_name', 'last_name', 'title', 'mobile', 'work_phone', 'email', 'comments', ];
	$x->ColNumber  = [2, 3, 4, 5, 6, 7, 8, 9, ];

	// template paths below are based on the app main directory
	$x->Template = 'templates/client_contacts_templateTV.html';
	$x->SelectedTemplate = 'templates/client_contacts_templateTVS.html';
	$x->TemplateDV = 'templates/client_contacts_templateDV.html';
	$x->TemplateDVP = 'templates/client_contacts_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HasCalculatedFields = false;
	$x->AllowConsoleLog = false;
	$x->AllowDVNavigation = true;

	// hook: client_contacts_init
	$render = true;
	if(function_exists('client_contacts_init')) {
		$args = [];
		$render = client_contacts_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: client_contacts_header
	$headerCode = '';
	if(function_exists('client_contacts_header')) {
		$args = [];
		$headerCode = client_contacts_header($x->ContentType, getMemberInfo(), $args);
	}

	if(!$headerCode) {
		include_once(__DIR__ . '/header.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/header.php');
		echo str_replace('<%%HEADER%%>', ob_get_clean(), $headerCode);
	}

	echo $x->HTML;

	// hook: client_contacts_footer
	$footerCode = '';
	if(function_exists('client_contacts_footer')) {
		$args = [];
		$footerCode = client_contacts_footer($x->ContentType, getMemberInfo(), $args);
	}

	if(!$footerCode) {
		include_once(__DIR__ . '/footer.php'); 
	} else {
		ob_start();
		include_once(__DIR__ . '/footer.php');
		echo str_replace('<%%FOOTER%%>', ob_get_clean(), $footerCode);
	}
