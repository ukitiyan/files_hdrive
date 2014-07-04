# Premise:
* installed smbclient 
* enabled files_external App
* enabled user_ldap App And set
* not running On Windows
* set files_hdrive App

# Settings:
insert oc_appconfig
 
    insert into oc_appconfig values ('files_hdrive', 'host', '10.0.0.1'); // AD's Host
    insert into oc_appconfig values ('files_hdrive', 'shar', '/R_AllUsers'); // Shared Directory
    insert into oc_appconfig values ('files_hdrive', 'mountpoint', 'MyDocument'); // Display Directory Name
    insert into oc_appconfig values ('files_hdrive', 'group', 'Group001'); // Enable Function Group

# Description:
When performing the Folder Redirection, folder for each user will be exclusive.
There is a problem at that time
To cifs mount the folder for each user, the authority of the user is required.
at the time you login to owncloud, files_hdrive performs cifs mount in the user privileges.
In addition, at the timing of the logout, I will release the cifs mount.
So I resolve

Configuration of Mount

    [host]:[share]/$user/

* $user : AD for cooperation is the premise, it is in the folder the same name as the folder redirection

It's still in development. I welcome every feedback and bug report.
Supported: Owncloud 6