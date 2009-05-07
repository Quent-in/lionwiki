<?php
class SelectLanguage
{
	var $desc = array(
		array("SelectLanguage", "creates select box in which you can choose language.")
	);

	var $lang_names = array(
		"ar" => "العربية",
		"bg" => "Български",
		"ca" => "Català",
		"cs" => "Čeština",
		"de" => "Deutsch",
		"de-ch" => "Schweizerdeutsch",
		"da" => "Dansk",
		"en" => "English",
		"eo" => "Esperanto",
		"es" => "Español",
		"fi" => "Eesti",
		"fr" => "Français",
		"hr" => "Hrvatski",
		"hu" => "Magyar",
		"it" => "Italiano",
		"nl" => "Nederlands",
		"pl" => "Polski",
		"pt" => "Português",
		"pt-br" => "Português brasileiro",
		"ro" => "Română",
		"ru" => "Русский",
		"sk" => "Slovenština",
		"sv" => "Svenska"
	);

	function template() {
		global $html, $LANG, $LANG_DIR, $CON, $page_nolang, $action;

		$langs = array();

		if(is_dir($LANG_DIR) && ($dir = opendir($LANG_DIR))) // common plugins
			while(($file = readdir($dir)) !== false)
				if(!is_dir($LANG_DIR . $file))
					$langs[] = basename($file, ".php");

		sort($langs);

		$select = "
<form action=\"$self\" id=\"formSelectLanguage\" method=\"get\">
<input type=\"hidden\" name=\"page\" value=\"" . htmlspecialchars($page_nolang) . "\" />
<input type=\"hidden\" name=\"action\" value=\"" . htmlspecialchars($action) . "\" />
<select name=\"lang\" id=\"selectLanguage\" onchange=\"this.form.submit();\">
";

		foreach($langs as $l) {
			$selected = $l == $LANG ? " selected=\"selected\" " : "";

			$select .= "<option value=\"$l\"$selected>" . $this->lang_names[$l] . "</option>\n";
		}

		$select .= "</select></form>\n";

		$html = template_replace("plugin:SELECT_LANGUAGE", $select, $html);
		$CON = str_replace("{SELECT_LANGUAGE}", $select, $CON);
	}
}