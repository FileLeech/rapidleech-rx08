<?
/*
This program is free software; you can redistribute it and/or modify
under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/

/**********************************\
* filename: config.php             *
* date:     5/6/2002               *
* Notes:    Edit this file, rather *
*           than the server script *
\**********************************/

global $mime_dl;
global $server;
global $redirectIP;
global $fileVar;
global $encryptPage;
/*Mime Types***********************\
* These are mime types you don't   *
* want to have downloaded by       *
* default (false is required)      *
\**********************************/
$mime_dl["text/html"]=false;
$mime_dl["application/pdf"]=false;
$mime_dl["application/x-javascript"]=false;
$mime_dl["application/x-shockwave-flash"]=false;
$mime_dl["image/bmp"]=false;
$mime_dl["image/gif"]=false;
$mime_dl["image/jpeg"]=false;
$mime_dl["image/tiff"]=false;
$mime_dl["text/css"]=false;
$mime_dl["text/directory"]=false;
$mime_dl["text/plain"]=false;

/*Server Vars***********************\
* Change these to match your server *
* Comment out redirectIP to have    *
* the proxy work on all ips (by     *
* absolute URLs)                    *
\***********************************/
$server = "http://php-proxy.sourceforge.net";
$redirectIP = "http://www.sourceforge.net";
$fileVar="file";
?>
