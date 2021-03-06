<?php  //$Id: upgrade.php,v 1.2 2007/08/08 22:36:54 stronk7 Exp $

// This file keeps track of upgrades to
// the voiceshadow module
//
// Sometimes, changes between versions involve
// alterations to database structures and other
// major things that may break installations.
//
// The upgrade function in this file will attempt
// to perform all the necessary actions to upgrade
// your older installtion to the current version.
//
// If there's something it cannot do itself, it
// will tell you what you need to do.
//
// The commands in here will all be database-neutral,
// using the functions defined in lib/ddllib.php

function xmldb_voiceshadow_upgrade($oldversion=0) {

    global $CFG, $THEME, $DB;

    $result = true;

    $dbman = $DB->get_manager();

    if ($oldversion < 2013030200) {
        $table = new xmldb_table('voiceshadow');
        $field = new xmldb_field('allowmultiple', XMLDB_TYPE_INTEGER, '2', null,
                                 XMLDB_NOTNULL, null, '0', 'emailteachers');

        // Conditionally launch add field requiresubmissionstatement.

        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2013030200, 'voiceshadow');
    }

    if ($oldversion < 2014030200) {
        // Define table assign_user_mapping to be created.
        $table = new xmldb_table('voiceshadow_likes');

        // Adding fields to table assign_user_mapping.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('instance', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('fileid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('time', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');

        // Adding keys to table assign_user_mapping.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('user', XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));

        // Conditionally launch create table for assign_user_mapping.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2014030200, 'voiceshadow');
    }


    if ($oldversion < 2014080400) {
        // Define table assign_user_mapping to be created.
        $table = new xmldb_table('voiceshadow');

        $field = new xmldb_field('gradet', XMLDB_TYPE_INTEGER, '11', null,
                                 XMLDB_NOTNULL, null, '0', 'grade');

        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        $field = new xmldb_field('grademethodt', XMLDB_TYPE_CHAR, '255', null,
                                 XMLDB_NOTNULL, null, 'default', 'grademethod');

        // Conditionally launch add field.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2014080400, 'voiceshadow');
    }

    if ($oldversion < 2017030300) {
        // Define table assign_user_mapping to be created.
        $table = new xmldb_table('voiceshadow_appfiles');

        // Adding fields to table assign_user_mapping.
        $table->add_field('id', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, XMLDB_SEQUENCE, null);
        $table->add_field('instance', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('fileid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('sourcefileid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('var', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('userid', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $table->add_field('time', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');

        // Adding keys to table assign_user_mapping.
        $table->add_key('primary', XMLDB_KEY_PRIMARY, array('id'));
        $table->add_key('user', XMLDB_KEY_FOREIGN, array('userid'), 'user', array('id'));

        // Conditionally launch create table for assign_user_mapping.
        if (!$dbman->table_exists($table)) {
            $dbman->create_table($table);
        }

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2017030300, 'voiceshadow');
    }

    if ($oldversion < 2017063000) {
        // Define table assign_user_mapping to be created.
        //$table = new xmldb_table('voiceshadow_appfiles');
        //$field = new xmldb_field('text', XMLDB_TYPE_TEXT, 'small', null, null, null, null, 'userid');
        // Launch change of type for field grade.
        //$dbman->add_field($table, $field);

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2017063000, 'voiceshadow');
    }


    if ($oldversion < 2017073000) {
        // Define table assign_user_mapping to be created.
        //$table = new xmldb_table('voiceshadow');

        // Adding fields to table assign_user_mapping.
        //$table->add_field('shadowingmode', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '1', 'showspeedbox');

        // Launch change of type for field grade.
        //$dbman->add_field($table, $field);

        $table = new xmldb_table('voiceshadow');
        $field = new xmldb_field('shadowingmode', XMLDB_TYPE_INTEGER, '2', null, null, null, '1', null);
        // Launch change of type for field grade.
        $dbman->add_field($table, $field);

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2017073000, 'voiceshadow');
    }

    if ($oldversion < 2019090100) {
        $table = new xmldb_table('voiceshadow');
        $field = new xmldb_field('speechtotextlang', XMLDB_TYPE_CHAR, '12', null,  XMLDB_NOTNULL, null, 'en', 'timemodified');
        // Launch change of type for field grade.
        $dbman->add_field($table, $field);

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2019090100, 'voiceshadow');
    }


    /*
    if ($oldversion < 2018033000) {
        $table = new xmldb_table('voiceshadow');

        $field = new xmldb_field('showscore', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $dbman->add_field($table, $field);
        $field = new xmldb_field('speechtotext', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0');
        $dbman->add_field($table, $field);
        $field = new xmldb_field('showspeedbox', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0');
        $dbman->add_field($table, $field);
        $field = new xmldb_field('shadowingmode', XMLDB_TYPE_INTEGER, '2', null, XMLDB_NOTNULL, null, '0');
        $dbman->add_field($table, $field);

        $field = new xmldb_field('var1transcript', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $dbman->add_field($table, $field);
        $field = new xmldb_field('var2transcript', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $dbman->add_field($table, $field);
        $field = new xmldb_field('var3transcript', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $dbman->add_field($table, $field);
        $field = new xmldb_field('var4transcript', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $dbman->add_field($table, $field);
        $field = new xmldb_field('var5transcript', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $dbman->add_field($table, $field);

        // Assign savepoint reached.
        upgrade_mod_savepoint(true, 2018033000, 'voiceshadow');
    }
    */
/*
    if ($oldversion < 2018043000) {
        $table = new xmldb_table('voiceshadow_files');

        $field = new xmldb_field('speechtext', XMLDB_TYPE_TEXT, 'small', null, null, null, null);
        $dbman->add_field($table, $field);

        $field = new xmldb_field('speed', XMLDB_TYPE_INTEGER, '10', null, XMLDB_NOTNULL, null, '0');
        $dbman->add_field($table, $field);

        upgrade_mod_savepoint(true, 2018043000, 'voiceshadow');
    }
*/


    return $result;
}

?>
