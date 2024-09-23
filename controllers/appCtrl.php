<?php
function isAdmin()
{
	return isset($_SESSION["userInfo"]) && $_SESSION["userInfo"]["role"] == '2';
}

function isComptable()
{
	return isset($_SESSION["userInfo"]) && $_SESSION["userInfo"]["role"] == '1';
}

function isMagasinier()
{
	return isset($_SESSION["userInfo"]) && $_SESSION["userInfo"]["role"] == '0';
}
