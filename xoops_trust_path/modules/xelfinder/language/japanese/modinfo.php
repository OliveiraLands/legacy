<?php

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) ) $mydirname = 'xelfinder' ;
$constpref = '_MI_' . strtoupper( $mydirname ) ;

if( defined( 'FOR_XOOPS_LANG_CHECKER' ) || ! defined( $constpref.'_LOADED' ) ) {

// a flag for this language file has already been read or not.
define( $constpref.'_LOADED' , 1 ) ;

// admin menu
define($constpref.'_ADMENU_MYLANGADMIN' ,   '�����������' ) ;
define($constpref.'_ADMENU_MYTPLSADMIN' ,   '�ƥ�ץ졼�ȴ���' ) ;
define($constpref.'_ADMENU_MYBLOCKSADMIN' , '�֥�å�����/������������' ) ;
define($constpref.'_ADMENU_MYPREFERENCES' , '��������' ) ;

// configurations
define( $constpref.'_VOLUME_SETTING' ,          '�ܥ�塼��ɥ饤��' );
define( $constpref.'_VOLUME_SETTING_DESC' ,     '[�⥸�塼��ǥ��쥯�ȥ�̾]:[�ץ饰����̾]:[�ե������Ǽ�ǥ��쥯�ȥ�]:[ɽ��̾]' );
define( $constpref.'_SHARE_HOLDER' ,            '��ͭ�ۥ��' );
define( $constpref.'_DEFAULT_ITEM_PERM' ,       '��������륢���ƥ�Υѡ��ߥå����' );
define( $constpref.'_DEFAULT_ITEM_PERM_DESC' ,  '�ѡ��ߥå�����3���[�ե����륪���ʡ�][���롼��][������]<br />�Ʒ� 2�ʿ�4bit�� [��ɽ��(h)][�ɤ߹���(r)][�񤭹���(w)][��å����(u)]<br />744: �����ʡ� 7 = -rwu, ���롼�� 4 = -r--, ������ 4 = -r--' );
define( $constpref.'_USE_USERS_DIR' ,           '�桼�����̥ۥ���λ���' );
define( $constpref.'_USE_USERS_DIR_DESC' ,      '' );
define( $constpref.'_USERS_DIR_PERM' ,          '�桼�����̥ۥ���Υѡ��ߥå����' );
define( $constpref.'_USERS_DIR_PERM_DESC' ,     '��: 7cc: �����ʡ� 7 = -rwu, ���롼�� c = hr--, ������ c = hr--' );
define( $constpref.'_USERS_DIR_ITEM_PERM' ,     '�桼�����̥ۥ���˺�������륢���ƥ�Υѡ��ߥå����' );
define( $constpref.'_USERS_DIR_ITEM_PERM_DESC' ,'��: 7cc: �����ʡ� 7 = -rwu, ���롼�� c = hr--, ������ c = hr--' );
define( $constpref.'_USE_GUEST_DIR' ,           '�������ѥۥ���λ���' );
define( $constpref.'_USE_GUEST_DIR_DESC' ,      '' );
define( $constpref.'_GUEST_DIR_PERM' ,          '�������ѥۥ���Υѡ��ߥå����' );
define( $constpref.'_GUEST_DIR_PERM_DESC' ,     '��: 766: �����ʡ� 7 = -rwu, ���롼�� 6 = -rw-, ������ 6 = -rw-' );
define( $constpref.'_GUEST_DIR_ITEM_PERM' ,     '�������ѥۥ���˺�������륢���ƥ�Υѡ��ߥå����' );
define( $constpref.'_GUEST_DIR_ITEM_PERM_DESC' ,'��: 744: �����ʡ� 7 = -rwu, ���롼�� 4 = -r--, ������ 4 = -r--' );
define( $constpref.'_USE_GROUP_DIR' ,           '���롼���̥ۥ���λ���' );
define( $constpref.'_USE_GROUP_DIR_DESC' ,      '' );
define( $constpref.'_GROUP_DIR_PARENT' ,        '���롼���̥ۥ���οƥۥ��̾' );
define( $constpref.'_GROUP_DIR_PARENT_DESC' ,   '' );
define( $constpref.'_GROUP_DIR_PARENT_NAME' ,   '���롼�������');
define( $constpref.'_GROUP_DIR_PERM' ,          '���롼���̥ۥ���Υѡ��ߥå����' );
define( $constpref.'_GROUP_DIR_PERM_DESC' ,     '��: 768: �����ʡ� 7 = -rwu, ���롼�� 6 = -rw-, ������ 8 = h---' );
define( $constpref.'_GROUP_DIR_ITEM_PERM' ,     '���롼���̥ۥ���˺�������륢���ƥ�Υѡ��ߥå����' );
define( $constpref.'_GROUP_DIR_ITEM_PERM_DESC' ,'��: 748: �����ʡ� 7 = -rwu, ���롼�� 4 = -r--, ������ 8 = h---' );

}
