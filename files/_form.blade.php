<?php echo Former::horizontal_open()->action($formAction)->method($formMethod)->rules($formRules); ?>
<?php echo Former::token(); ?>
<?php echo Former::populate($$${resource}); ?>
<p>An asterisk<sup>*</sup> indicates required information.</p>
${cursor}
<?php echo Former::actions()->success_submit(Lang::get($formLang.'submit'), array('data-loading-text'=>Lang::get($formLang.'submitLoading'))); ?>
<?php echo Former::close(); ?>

@if ($formVersion == 'edit')
  <?php
  echo Button::danger_mini_link(
    URL::action('${Controller}Controller@destroy', array('id'=>$$${resource}['id'])), Lang::get($formLang.'destroy'), array(
    'data-method'=>'DELETE',
    'class'=>'action_confirm',
  ))->with_icon('trash');
  ?>
<script>
  var confirmationMessage = "<?php echo Lang::get($formLang.'confirmDestroyWarning', array('name'=>$$${resource}->name)) ?>";
  var confirmationBtnYes = "<?php echo Lang::get($formLang.'confirmDestroyYes') ?>";
  var confirmationBtnNo = "<?php echo Lang::get($formLang.'confirmDestroyNo') ?>";
  var sessionToken = "<?php echo Session::getToken() ?>";
</script>
@endif