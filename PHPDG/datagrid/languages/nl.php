<?php
//------------------------------------------------------------------------------
//*** Netherlands / "Vlaams" (Flemish) (nl)
//------------------------------------------------------------------------------
function setLanguageNl(){ 
    $lang['='] = "=";  // "equal";
    $lang['!='] = "!="; // "not equal"; 
    $lang['>'] = ">";  // "bigger";
    $lang['>='] = ">=";  // "bigger or equal";
    $lang['<'] = "<";  // "smaller";
    $lang['<='] = "<=";  // "smaller or equal";            
    $lang['add'] = "Toevoegen"; 
    $lang['add_new'] = "+ nieuw"; 
    $lang['add_new_record'] = "Voeg nieuwe record toe";
    $lang['add_new_record_blocked'] = "Security check: poging van het toevoegen van een nieuw record! Controleer uw instellingen, wordt de operatie niet toegestaan!";    
    $lang['adding_operation_completed'] = "Toevoegen is geslaagd!";
    $lang['adding_operation_uncompleted'] = "Toevoegen is niet voltooid!";
    $lang['alert_perform_operation'] = "Weet u zeker dat u de uitvoering van deze operatie?";
    $lang['alert_select_row'] = "U moet Selecteer een of meer rijen voor het uitvoeren van deze operatie!";    
	$lang['alert_field_cannot_be_empty'] = 'Field {title} cannot be empty! Please re-enter.';
	$lang['alert_field_must_be_alphabetic'] = 'Field {title} must have alphabetic value! Please re-enter.';
	$lang['alert_field_must_be_float'] = 'Field {title} must be a float value! Please re-enter.';
	$lang['alert_field_must_be_integer'] = 'Field {title} must be an integer value! Please re-enter.';
    $lang['and'] = "en"; 
    $lang['any'] = "eender"; 
    $lang['ascending'] = "Oplopend";  
    $lang['back'] = "Terug";
    $lang['cancel'] = "Annuleer"; 
    $lang['cancel_creating_new_record'] = "Aanmaken van nieuwe record annuleren: bent u zeker?"; 
    $lang['check_all'] = "Markeer alles";
    $lang['clear'] = "Duidelijk";
    $lang['click_to_download'] = "Klik om te downloaden";
    $lang['clone_selected'] = "Kloon geselecteerd";
    $lang['cloning_record_blocked'] = "Security check: poging van het klonen van een record! Controleer uw instellingen, wordt de operatie niet toegestaan!";
    $lang['cloning_operation_completed'] = "Het klonen bewerking is voltooid!";
    $lang['cloning_operation_uncompleted'] = "Het klonen onvoltooide!";
    $lang['create'] = "Maak nieuw"; 
    $lang['create_new_record'] = "Maak nieuwe record"; 
    $lang['current'] = "huidige";
    $lang['delete'] = "Verwijder"; 
    $lang['delete_record'] = "Verwijder record";
    $lang['delete_record_blocked'] = "Security check: poging van het verwijderen van een record! Controleer uw instellingen, is de operatie niet toegestaan!";    
    $lang['delete_selected'] = "Geselecteerde"; 
    $lang['delete_selected_records'] = "Geselecteerde records verwijderen: bent u zeker?"; 
    $lang['delete_this_record'] = "Deze record verwijderen: bent u zeker?"; 
    $lang['deleting_operation_completed'] = "Verwijderen is geslaagd!"; 
    $lang['deleting_operation_uncompleted'] = "Verwijderen is niet voltooid!";
    $lang['descending'] = "Aflopend"; 
    $lang['details'] = "Details";
    $lang['details_selected'] = "Bekijk selectie";
    $lang['download'] = "Downloaden";    
    $lang['edit'] = "Wijzig";
    $lang['edit_selected'] = "Wijzig selectie";
    $lang['edit_record'] = "Wijzig record";
    $lang['edit_selected_records'] = "Bent u zeker dat u de geselecteerde records wilt wijzigen?";   
    $lang['errors'] = "Fouten";
	$lang['exchange_operation_completed'] = "The exchange columns operation on selected rows completed successfully!";
	$lang['exchange_operation_uncompleted'] = "The exchange columns operation on selected rows uncompleted!";
	$lang['exchange_selected'] = "Exchange columns in selected rows";
    $lang['export_to_excel'] = "Exporteer naar Excel";
    $lang['export_to_pdf'] = "Exporteer naar PDF";
    $lang['export_to_word'] = "Exporteer naar Word";
    $lang['export_to_xml'] = "Exporteer naar XML";
    $lang['export_message'] = "<label class=\"default_dg_label\">Het bestand _FILE_ is klaar. Wanneer u klaar bent met downloaden,</label> <a class=\"default_dg_error_message\" href=\"javascript: window.close();\">sluit dit venster</a>.";
    $lang['field'] = "Veld"; 
    $lang['field_value'] = "Waarde";
    $lang['file_find_error'] = "Kan bestand niet vinden: <b>_FILE_</b>. <br>Controleer of dit bestand bestaat!";
    $lang['file_opening_error'] = "Kan bestand niet openen. Kijk toegangsrechten na.";
    $lang['file_extension_error'] = "File upload error: file extension not allowed for upload. Please select another file.";
    $lang['file_writing_error'] = "Kan niet naar bestand schrijven. Kijk schrijfrechten na!"; 
    $lang['file_invalid_file_size'] = "Ongeldige bestandsgrootte!"; 
    $lang['file_uploading_error'] = "Fout bij uploaden bestand: probeer opnieuw!";
    $lang['file_deleting_error'] = "Bestand kon niet verwijderd worden!";
    $lang['first'] = "eerste";
    $lang['format'] = "Formaat";
    $lang['generate'] = "Het genereren van";
    $lang['handle_selected_records'] = "Bent u zeker dat u de geselecteerde records wilt gebruiken?";
    $lang['hide_search'] = "Verberg zoeken"; 
    $lang['item'] = "item";
    $lang['items'] = "artikelen";
    $lang['last'] = "laatste"; 
    $lang['like'] = "zoals";
    $lang['like%'] = "zoals%";  // "begins with"; 
    $lang['%like'] = "%zoals";  // "ends with";
    $lang['%like%'] = "%zoals%";  
    $lang['loading_data'] = "bezig met laden...";
    $lang['max'] = "max";
    $lang['max_number_of_records'] = "Je hebt het maximale aantal toegestane records!";
    $lang['move_down'] = "Omlaag";
    $lang['move_up'] = "Omhoog";
    $lang['move_operation_completed'] = "De bewegende rij-operatie is voltooid!";
    $lang['move_operation_uncompleted'] = "De bewegende rij-operatie onvoltooide!";    
    $lang['next'] = "volgende"; 
    $lang['no'] = "Nee"; 
    $lang['no_data_found'] = "Geen gegevens gevonden"; 
    $lang['no_data_found_error'] = "Geen gegevens gevonden! Kijk de syntax van uw code goed na!<br>Er kunnen problemen zijn met hoofdlettergevoeligheid of met onverwachte symbolen."; 
    $lang['no_image'] = "Geen afbeelding"; 
    $lang['not_like'] = "niet zoals"; 
    $lang['of'] = "van";
    $lang['operation_was_already_done'] = "De operatie was reeds voltooid! Je kunt niet weer opnieuw proberen het.";            
    $lang['or'] = "van"; 
    $lang['pages'] = "Pagina's"; 
    $lang['page_size'] = "Paginalengte"; 
    $lang['previous'] = "vorige"; 
    $lang['printable_view'] = "Afdrukvoorbeeld"; 
    $lang['print_now'] = "Nu afdrukken"; 
    $lang['print_now_title'] = "Klik hier om deze pagina af te drukken"; 
    $lang['record_n'] = "Record #";
    $lang['refresh_page'] = "Pagina vernieuwen";    
    $lang['remove'] = "Verwijder";
    $lang['reset'] = "Reset";
    $lang['results'] = "Resultaten";
    $lang['required_fields_msg'] = "Velden gemarkeerd met <span style='color:#cd0000'>*</span> zijn vereist"; 
    $lang['search'] = "Zoek"; 
    $lang['search_d'] = "Zoek"; // (description) 
    $lang['search_type'] = "Zoeken met"; 
    $lang['select'] = "Selecteer"; 
    $lang['set_date'] = "Stel datum in";
    $lang['sort'] = "Sorteren";        
    $lang['test'] = "Test";
    $lang['total'] = "Totaal";
    $lang['turn_on_debug_mode'] = "Schakel debug modus in voor meer informatie.";
    $lang['uncheck_all'] = "Niets gemarkeerd"; 
    $lang['unhide_search'] = "Toon zoeken";
    $lang['unique_field_error'] = "Het veld _FIELD_ laat enkel unieke waarden toe - opnieuw invoegen aub!";
    $lang['update'] = "Bijwerken"; 
    $lang['update_record'] = "Record bijwerken";
    $lang['update_record_blocked'] = "Security check: poging van het bijwerken van een record! Controleer uw instellingen, is de operatie niet toegestaan!";    
    $lang['updating_operation_completed'] = "Bijwerken is geslaagd!"; 
    $lang['updating_operation_uncompleted'] = "Bijwerken is niet voltooid!"; 
    $lang['upload'] = "Uploaden";
    $lang['uploaded_file_not_image'] = "Het ge&uuml;ploade bestand lijkt niet te zijn een afbeelding.";    
    $lang['view'] = "Details"; 
    $lang['view_details'] = "Bekijk details";
    $lang['warnings'] = "Waarschuwingen";
    $lang['with_selected'] = "Met geselecteerde"; 
    $lang['wrong_field_name'] = "Verkeerde veldnaam";
    $lang['wrong_parameter_error'] = "Verkeerde parameter in [<b>_FIELD_</b>]: _VALUE_";
    $lang['yes'] = "Ja"; 

    // date-time
    $lang['day']    = "dag";
    $lang['month']  = "maanden";
    $lang['year']   = "jaar";
    $lang['hour']   = "uur";
    $lang['min']    = "min";
    $lang['sec']    = "sec";
    $lang['months'][1] = "Januari";
    $lang['months'][2] = "Februari";
    $lang['months'][3] = "Maart";
    $lang['months'][4] = "April";
    $lang['months'][5] = "Kan";
    $lang['months'][6] = "Juni";
    $lang['months'][7] = "Juli";
    $lang['months'][8] = "Augustus";
    $lang['months'][9] = "September";
    $lang['months'][10] = "Oktober";
    $lang['months'][11] = "November";
    $lang['months'][12] = "December";
        
    return $lang; 
}
