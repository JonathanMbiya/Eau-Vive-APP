<?php

function inputCheckbox($id, $name, $isChecked = false)
{
?>
	<input id="<?= $id ?>" name="<?= $name ?>" type="checkbox" class="w-4 h-4 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:bg-gray-900/50 dark:border-gray-900" <?php if ($isChecked) { ?> checked <?php } ?>>
<?php
}
function inputHidden($name, $value)
{
?>
	<input type="hidden" name="<?= $name ?>" value="<?= $value ?>" />
<?php
}
function inputForm($type, $id, $name, $placeholder, $isRequired = false, $value = array())
{
?>
	<input <?php if ($value && key_exists('value', $value)) { ?> value="<?= $value['value'] ?>" <?php } ?> type="<?= $type ?>" name="<?= $name ?>" id="<?= $id ?>" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="<?= $placeholder ?>" <?php if ($isRequired) { ?> required <?php } ?> <?php if ($value && key_exists('isReadonly', $value) && $value["isReadonly"] == "true") { ?> readonly <?php } ?>>
<?php
}

function selectForm($id, $name, $placeholder, $isRequired = false, $values = array(), $defaultValue)
{
?>
	<select name="<?= $name ?>" id="<?= $id ?>" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" <?php if ($isRequired) { ?> required <?php } ?>>
		<option value=""><?= $placeholder ?></option>
		<?php
		foreach ($values as $key => $value) {
		?>
			<option value="<?= $key ?>" <?php if ($defaultValue == $key) { ?> selected <?php } ?>><?= $value ?></option>
		<?php
		}
		?>
	</select>

<?php
}

function inputTextArea($id, $name, $placeholder, $isRequired = false, $value = array())
{
	$showValue = (!empty($value) && key_exists('value', $value)) ? $value['value'] : "";

?>
	<textarea name="<?= $name ?>" id="<?= $id ?>" placeholder="<?= $placeholder ?>" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-900/50 dark:border-gray-900 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 h-40" <?php if ($isRequired) { ?> required <?php } ?>>
	<?= $showValue   ?>
</textarea>
<?php
}

function inputFormGroupLabel($label, $type, $id, $name, $placeholder, $isRequired = false, $value = [])
{
?>
	<div>
		<label for="<?= $id ?>" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
			<?= $label ?>
		</label>
		<?php
		inputForm($type, $id, $name, $placeholder, $isRequired, $value);
		?>
	</div>
<?php
}
function inputFormSelectGroupLabel($label, $id, $name, $placeholder, $values = array(), $isRequired = false, $defaultValue = '')
{
?>
	<div>
		<label for="<?= $id ?>" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
			<?= $label ?>
		</label>
		<?php
		selectForm($id, $name, $placeholder, $isRequired, $values, $defaultValue);
		?>
	</div>
<?php
}

function inputTextAreaGroupLabel($label, $id, $name, $placeholder, $isRequired = false, $value = array())
{
?>
	<div>
		<label for="<?= $id ?>" class="block mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
			<?= $label ?>
		</label>
		<?php
		inputTextArea($id, $name, $placeholder, $isRequired, $value);
		?>
	</div>
<?php
}
