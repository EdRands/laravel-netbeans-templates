<?php

/**
 * ${name?replace("Controller", "")} Resource Controller
 */
class ${name} extends \BaseController {

/**
 * @var string $langBase Base language location
 */
public static $langBase = '${name?uncap_first?replace("Controller", "")}.';

/**
 * @var strng $viewBase Base view directory
 */
public static $viewBase = '${name?uncap_first?replace("Controller", "")}.';

/**
 * @var string $actionBase Base for action() routing
 */
public static $actionBase = '${name}@';

/**
 * @var int $showPerPage How many ${name?uncap_first?replace("Controller", "")}s to show at a time.
 */
public static $showPerPage = 50;

public function __construct() {
$this->beforeFilter('auth');
$this->beforeFilter('csrf', array('on'=>'post|put|delete'));
}

/**
 * Display a listing of ${name?uncap_first?replace("Controller", "")}s.
 *
 * @return Response
 */
public function index() {
// Setup the common basics
$data = $this->setupCommonVariables('index');

// Grab the paginated list of ${name?uncap_first?replace("Controller", "")}s
$${name?uncap_first?replace("Controller", "")} = new ${name?replace("Controller", "")};
$data['${name?uncap_first?replace("Controller", "")}s'] = $${name?uncap_first?replace("Controller", "")}->orderBy('id', 'asc')->paginate(static::$showPerPage);

// Show the view
return View::make(static::$viewBase.'index', $data);
}

/**
 * Display the specified ${name?uncap_first?replace("Controller", "")}.
 *
 * @param  int  $id
 * @return Response
 */
public function show($id) {
// Setup the common basics
$data = $this->setupCommonVariables('show');

// Get the ${name?uncap_first?replace("Controller", "")}
$data['${name?uncap_first?replace("Controller", "")}'] = ${name?replace("Controller", "")}::find($id);

// Show the view
return View::make(static::$viewBase.'show', $data);
}

/**
 * Show the form for creating a new ${name?uncap_first?replace("Controller", "")}.
 *
 * @return Response
 */
public function create() {
// Setup the common basics
$data = $this->setupCommonVariables('create');

// Setup form variables
$data = array_merge($data, $this->setupFormVariables('create', 'store', array(), 'POST'));

// Get empty ${name?uncap_first?replace("Controller", "")} for form rules
$data['${name?uncap_first?replace("Controller", "")}'] = new ${name?replace("Controller", "")};

// Show the view
return View::make(static::$viewBase.'create', $data);
}

/**
 * Save a newly created ${name?uncap_first?replace("Controller", "")}.
 *
 * @return Response
 */
public function store() {
// Sanitize input
$input = $this->sanitizeInput(array('field', ));

// Create an empty ${name?uncap_first?replace("Controller", "")}
$${name?uncap_first?replace("Controller", "")} = new ${name?replace("Controller", "")};

// Assign the input to the ${name?uncap_first?replace("Controller", "")}
$this->inputToResource($${name?uncap_first?replace("Controller", "")}, $input);

if ($${name?uncap_first?replace("Controller", "")}->save()) {
// Saved. Show it
return Redirect::action(static::$actionBase.'show', array('id'=>$${name?uncap_first?replace("Controller", "")}->id));
}
else {
// Didn't save. Validation fail. Input again.
return Redirect::action(static::$actionBase.'create')->withInput($input)->withErrors($${name?uncap_first?replace("Controller", "")}->errors());
}
}

/**
 * Show the form for editing the specified ${name?uncap_first?replace("Controller", "")}.
 *
 * @param  int  $id
 * @return Response
 */
public function edit($id) {
// Setup the common basics
$data = $this->setupCommonVariables('edit');

// Setup form variables
$data = array_merge($data, $this->setupFormVariables('edit', 'update', array('id'=>$id), 'PUT'));

// Get the specified ${name?uncap_first?replace("Controller", "")}
$data['${name?uncap_first?replace("Controller", "")}'] = ${name?replace("Controller", "")}::find($id);

// Show the view
return View::make(static::$viewBase.'edit', $data);
//
}

/**
 * Update the specified ${name?uncap_first?replace("Controller", "")} in storage.
 *
 * @param  int  $id
 * @return Response
 */
public function update($id) {
// Sanitize input
$input = $this->sanitizeInput(array('field', ));

// Create an empty ${name?uncap_first?replace("Controller", "")}
$${name?uncap_first?replace("Controller", "")} = new ${name?replace("Controller", "")};

// Get the ${name?uncap_first?replace("Controller", "")}
$${name?uncap_first?replace("Controller", "")} = ${name?replace("Controller", "")}::find($id);

// Ignore self when checking uniqueness
$rules = ${name?replace("Controller", "")}::$rules;
$rules['code'] = Str::finish(${name?replace("Controller", "")}::$rules['code'], ",$id");

// Assign the input to the ${name?uncap_first?replace("Controller", "")}
$this->inputToResource($${name?uncap_first?replace("Controller", "")}, $input);

if ($${name?uncap_first?replace("Controller", "")}->save($rules)) {
// Saved it. Show it.
return Redirect::action(static::$actionBase.'show', array('id'=>$${name?uncap_first?replace("Controller", "")}->id));
}
else {
// Didn't save. Validation fail. Input again.
return Redirect::action(static::$actionBase.'edit', array('id'=>$id))->withInput($input)->withErrors($${name?uncap_first?replace("Controller", "")}->errors());
}
}

/**
 * Remove the specified ${name?uncap_first?replace("Controller", "")} from storage.
 *
 * @param  int  $id
 * @return Response
 */
public function destroy($id) {
// Delete the ${name?uncap_first?replace("Controller", "")}
${name?replace("Controller", "")}::destroy($id);

// Go back to the index
return Redirect::action(static::$actionBase.'index');
}

/**
 * Draws the menu for this controller
 *
 * @return string
 */
public static function navigation() {
$langBase = self::$langBase.'nav.';
return Navigation::links(
array(
array(Lang::get($langBase.'index'), URL::action(self::$actionBase.'index'), false, false, NULL, 'external-link', Auth::check()),
 )
);
}

/**
 * Sanitize user input
 * @param array $inputs
 * @return array
 */
public function sanitizeInput($inputs = array()) {
$output = array();
foreach ($inputs as $key) {
$output[$key] = Jinput::get($key);
}
return $output;
}

/**
 * Setup common variables for views
 *
 * @param string $action Action name
 * @return array
 */
public function setupCommonVariables($action) {
$data['actionBase'] = static::$actionBase;
$data['langBase'] = static::$langBase;
$data['langAction'] = '.'.Str::lower($action);
return $data;
}

/**
 * Setup common variables for forms
 *
 * @param string $action Action name
 * @param string $destinationAction Destination action name
 * @param array $parameters Action parameters
 * @param string $method Form method
 * @return array
 */
public function setupFormVariables($action, $destinationAction, $parameters = array(), $method = 'POST') {
$data['formAction'] = URL::action(static::$actionBase.$destinationAction, $parameters);
$data['formMethod'] = $method;
$data['formVersion'] = $action;
$data['formLang'] = static::$langBase.'form.'.$action.'.';
$data['formRules'] = Customer::$rules;
return $data;
}

/**
 * Save input to the ${name?uncap_first?replace("Controller", "")} by reference
 * @param array $input
 * @return void
 */
public function saveInputToResource(&$resource, $input) {
foreach ($input as $key=>$value) {
$resource->$key = $value;
}
}

}
?>