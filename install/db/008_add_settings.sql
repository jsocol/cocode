-- Migration: Add the default settings.

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'site_name', 'Example Site'),
(2, 'copyright', '&copy; 2009 Example Site'),
(4, 'diff_util', 'C:\\Progra~1\\GnuWin32\\bin\\diff.exe'),
(5, 'languages', 'a:126:{i:0;s:4:"abap";i:1;s:13:"actionscript3";i:2;s:12:"actionscript";i:3;s:3:"ada";i:4;s:6:"apache";i:5;s:11:"applescript";i:6;s:11:"apt_sources";i:7;s:3:"asm";i:8;s:3:"asp";i:9;s:6:"autoit";i:10;s:8:"avisynth";i:11;s:4:"bash";i:12;s:8:"basic4gl";i:13;s:2:"bf";i:14;s:10:"blitzbasic";i:15;s:3:"bnf";i:16;s:3:"boo";i:17;s:1:"c";i:18;s:5:"c_mac";i:19;s:6:"caddcl";i:20;s:7:"cadlisp";i:21;s:4:"cfdg";i:22;s:3:"cfm";i:23;s:3:"cil";i:24;s:5:"cobol";i:25;s:3:"cpp";i:26;s:6:"cpp-qt";i:27;s:6:"csharp";i:28;s:3:"css";i:29;s:1:"d";i:30;s:6:"delphi";i:31;s:4:"diff";i:32;s:3:"div";i:33;s:3:"dos";i:34;s:3:"dot";i:35;s:6:"eiffel";i:36;s:5:"email";i:37;s:7:"fortran";i:38;s:9:"freebasic";i:39;s:6:"genero";i:40;s:7:"gettext";i:41;s:4:"glsl";i:42;s:3:"gml";i:43;s:7:"gnuplot";i:44;s:6:"groovy";i:45;s:6:"haskel";i:46;s:7:"hp9plus";i:47;s:11:"html4strict";i:48;s:3:"idl";i:49;s:3:"ini";i:50;s:4:"inno";i:51;s:8:"intercal";i:52;s:2:"io";i:53;s:5:"java5";i:54;s:4:"java";i:55;s:10:"javascript";i:56;s:7:"kixtart";i:57;s:6:"klonec";i:58;s:8:"klonecpp";i:59;s:5:"latex";i:60;s:4:"lisp";i:61;s:7:"lolcode";i:62;s:13:"lotusformulas";i:63;s:11:"lotusscript";i:64;s:7:"lscript";i:65;s:3:"lua";i:66;s:4:"m68k";i:67;s:4:"make";i:68;s:6:"matlab";i:69;s:4:"mirc";i:70;s:5:"mpasm";i:71;s:4:"mxml";i:72;s:5:"mysql";i:73;s:4:"nsis";i:74;s:4:"objc";i:75;s:5:"ocaml";i:76;s:11:"ocaml-brief";i:77;s:5:"oobas";i:78;s:7:"oracle8";i:79;s:8:"oracle11";i:80;s:6:"pascal";i:81;s:3:"per";i:82;s:4:"perl";i:83;s:3:"php";i:84;s:9:"php-brief";i:85;s:5:"pic16";i:86;s:11:"pixelbender";i:87;s:5:"plsql";i:88;s:6:"povray";i:89;s:10:"powershell";i:90;s:8:"progress";i:91;s:6:"prolog";i:92;s:8:"providex";i:93;s:6:"python";i:94;s:6:"qbasic";i:95;s:5:"rails";i:96;s:3:"reg";i:97;s:6:"robots";i:98;s:4:"ruby";i:99;s:3:"sas";i:100;s:5:"scala";i:101;s:6:"scheme";i:102;s:6:"scilab";i:103;s:8:"sdlbasic";i:104;s:9:"smalltalk";i:105;s:6:"smarty";i:106;s:3:"sql";i:107;s:3:"tcl";i:108;s:8:"teraterm";i:109;s:4:"text";i:110;s:9:"thinbasic";i:111;s:4:"tsql";i:112;s:10:"typoscript";i:113;s:2:"vb";i:114;s:5:"vbnet";i:115;s:7:"verilog";i:116;s:4:"vhdl";i:117;s:3:"vim";i:118;s:12:"visualfoxpro";i:119;s:12:"visualprolog";i:120;s:10:"whitespace";i:121;s:8:"winbatch";i:122;s:3:"xml";i:123;s:9:"xorg_conf";i:124;s:3:"xpp";i:125;s:3:"z80";}'),
(6, 'permissions', 'a:9:{s:5:"admin";i:5;s:4:"view";i:1;s:4:"post";i:2;s:7:"comment";i:1;s:10:"delete_own";i:2;s:13:"delete_others";i:4;s:18:"delete_own_comment";i:2;s:21:"delete_others_comment";i:4;s:12:"view_profile";i:1;}'),
(7, 'user_levels', 'a:6:{i:0;s:15:"Unauthenticated";i:1;s:5:"Guest";i:2;s:4:"User";i:3;s:6:"Unused";i:4;s:9:"Moderator";i:5;s:13:"Administrator";}');

INSERT INTO `maveric` (`option`,`value`) VALUES ('db_version','8')
ON DUPLICATE KEY UPDATE
value = '8';