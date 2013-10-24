-- MySQL dump 9.11
--
-- Host: localhost    Database: ipgroup
-- ------------------------------------------------------
-- Server version	4.0.30-log

--
-- Table structure for table `mp_group_info`
--

CREATE TABLE mp_group_info (
  gid tinyint(3) unsigned NOT NULL auto_increment,
  seq tinyint(3) unsigned NOT NULL default '0',
  name varchar(20) NOT NULL default '',
  PRIMARY KEY  (gid),
  KEY seq (seq)
) TYPE=MyISAM COMMENT='�׷����� ���̺�';

--
-- Dumping data for table `mp_group_info`
--

INSERT INTO mp_group_info VALUES (1,1,'�ڵ�');
INSERT INTO mp_group_info VALUES (2,2,'�÷���');

--
-- Table structure for table `mp_project_info`
--

CREATE TABLE mp_project_info (
  pid tinyint(3) unsigned NOT NULL auto_increment,
  seq tinyint(3) unsigned NOT NULL default '0',
  name varchar(40) NOT NULL default '',
  PRIMARY KEY  (pid),
  KEY seq (seq)
) TYPE=MyISAM COMMENT='������Ʈ���� ���̺�';

--
-- Dumping data for table `mp_project_info`
--

INSERT INTO mp_project_info VALUES (1,1,'�Ե���ȭ��');
INSERT INTO mp_project_info VALUES (2,2,'�Ե����ͳݸ鼼��');
INSERT INTO mp_project_info VALUES (3,3,'�λ�Ե����ͳݸ鼼��');
INSERT INTO mp_project_info VALUES (4,4,'�Ե��ڿ������ͳݸ鼼��');
INSERT INTO mp_project_info VALUES (5,5,'�Ե��鼼��');
INSERT INTO mp_project_info VALUES (6,6,'�Ե����ͳݽ���');
INSERT INTO mp_project_info VALUES (7,7,'�Ե���Ʈ');
INSERT INTO mp_project_info VALUES (8,8,'�Ե��ƿ﷿');
INSERT INTO mp_project_info VALUES (9,9,'����������');
INSERT INTO mp_project_info VALUES (10,10,'�÷���');
INSERT INTO mp_project_info VALUES (11,11,'�Ե����� IR');
INSERT INTO mp_project_info VALUES (12,12,'�Ե���ȭ�� ��ǰ����');
INSERT INTO mp_project_info VALUES (13,13,'���񴺿�');
INSERT INTO mp_project_info VALUES (14,14,'����');
INSERT INTO mp_project_info VALUES (15,15,'��Ÿ');

--
-- Table structure for table `mp_type_info`
--

CREATE TABLE mp_type_info (
  tid tinyint(3) unsigned NOT NULL auto_increment,
  gid tinyint(3) unsigned NOT NULL default '0',
  seq tinyint(3) unsigned NOT NULL default '0',
  name varchar(20) NOT NULL default '',
  PRIMARY KEY  (tid),
  KEY gid (gid),
  KEY seq (seq)
) TYPE=MyISAM COMMENT='�������� ���̺�';

--
-- Dumping data for table `mp_type_info`
--

INSERT INTO mp_type_info VALUES (1,1,1,'�');
INSERT INTO mp_type_info VALUES (2,1,2,'����');
INSERT INTO mp_type_info VALUES (3,2,1,'�');
INSERT INTO mp_type_info VALUES (4,2,2,'����');

--
-- Table structure for table `mp_work_data`
--

CREATE TABLE mp_work_data (
  id int(10) unsigned NOT NULL auto_increment,
  gid tinyint(3) unsigned NOT NULL default '0',
  date date NOT NULL default '0000-00-00',
  pid tinyint(3) unsigned NOT NULL default '0',
  wid tinyint(3) unsigned NOT NULL default '0',
  tid tinyint(3) unsigned NOT NULL default '0',
  worktime float(3,1) NOT NULL default '0.0',
  work varchar(255) NOT NULL default '',
  PRIMARY KEY  (id),
  KEY date (date),
  KEY pid (pid),
  KEY wid (wid),
  KEY tid (tid),
  KEY gid (gid)
) TYPE=MyISAM COMMENT='�۾����� ���̺�';

--
-- Dumping data for table `mp_work_data`
--

INSERT INTO mp_work_data VALUES (1,1,'2010-12-01',1,1,1,0.5,'������,�Ȼ��� �˾� ��������');
INSERT INTO mp_work_data VALUES (2,1,'2010-12-02',1,2,1,0.5,'�Ե� ��Ű/���뺸�� �佺Ƽ��');
INSERT INTO mp_work_data VALUES (3,1,'2010-12-02',1,1,1,0.5,'���� �ε���, ������� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (4,1,'2010-12-03',1,1,1,4.0,'Happy Christmas & Adieu 2010 Party �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (5,1,'2010-12-06',1,1,1,1.5,'�Ե������ ���� ������ �̺�Ʈ ���޻� �ƿ﷿ �߰� �ڵ���û');
INSERT INTO mp_work_data VALUES (6,1,'2010-12-06',1,1,1,1.0,'�罺���� ��ȭ�û�ȸ ��÷��ǥ');
INSERT INTO mp_work_data VALUES (7,1,'2010-12-07',1,2,1,1.0,'�Ե������ ������ �̺�Ʈ ����/�������� �˾� �ڵ�');
INSERT INTO mp_work_data VALUES (8,1,'2010-12-07',1,2,1,0.5,'�Ƶ�2010��Ƽ ����');
INSERT INTO mp_work_data VALUES (9,1,'2010-12-07',1,2,1,1.0,'�뱸���� �ָ�����ǰ�̺�Ʈ');
INSERT INTO mp_work_data VALUES (10,1,'2010-12-07',1,1,1,2.0,'Happy Christmas & Adieu 2010 Party �̺�Ʈ �ڵ� ������û-������� �߰�');
INSERT INTO mp_work_data VALUES (11,1,'2010-12-07',1,1,1,1.5,'10�� ���� �¶��� ������� �ڵ���û(10�� �޼���)');
INSERT INTO mp_work_data VALUES (12,1,'2010-12-08',1,1,1,3.0,'���� ���� ����� ĳ���� �����̺�Ʈ');
INSERT INTO mp_work_data VALUES (13,1,'2010-12-08',1,2,1,0.5,'�����˾� �������� �� ����');
INSERT INTO mp_work_data VALUES (14,1,'2010-12-09',1,2,1,0.5,'�뱸���� ����ǰ �̺�Ʈ �˾� ����');
INSERT INTO mp_work_data VALUES (15,1,'2010-12-09',1,2,1,0.5,'ũ�������� ������� �ڵ� ����');
INSERT INTO mp_work_data VALUES (16,1,'2010-12-09',1,1,1,2.5,'����� ��ü �������� üũ�� �ϼ��� ������ �ڵ�');
INSERT INTO mp_work_data VALUES (17,1,'2010-12-09',1,1,1,1.0,'ũ�������� �ε���/������� �ڵ� ��û');
INSERT INTO mp_work_data VALUES (18,1,'2010-12-10',1,1,1,1.5,'ũ�������� �������� ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (19,1,'2010-12-10',1,1,1,3.0,'ũ�������� e-card ������ �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (20,1,'2010-12-10',1,1,1,1.0,'��ȭ�� ����� ����');
INSERT INTO mp_work_data VALUES (21,1,'2010-12-10',1,1,1,0.5,'10�� ���� �¶��� ������� ��Ʈ�� �Խ� ������û');
INSERT INTO mp_work_data VALUES (22,1,'2010-12-13',1,2,1,1.0,'�������� ũ�������� ������Ƽ');
INSERT INTO mp_work_data VALUES (23,1,'2010-12-13',1,1,1,2.0,'���Ե�N ��� ��ȭ��/��ȭ�� ��ư �߰� �ڵ���û');
INSERT INTO mp_work_data VALUES (24,1,'2010-12-13',1,1,1,4.0,'�Ե���ȭȦ �������� �߰�');
INSERT INTO mp_work_data VALUES (25,1,'2010-12-14',1,2,1,0.5,'û�ֿ����˾�');
INSERT INTO mp_work_data VALUES (26,1,'2010-12-14',1,1,1,1.5,'Happy Christmas & Adieu 2010 Party �̺�Ʈ �ڵ� ������û');
INSERT INTO mp_work_data VALUES (27,1,'2010-12-14',1,2,1,1.0,'�뱸���� �ָ�����ǰ�̺�Ʈ');
INSERT INTO mp_work_data VALUES (28,1,'2010-12-15',1,1,1,0.5,'��ȭ�� ���� ����� ������ �̺�Ʈ �˾� �Խ� �����û');
INSERT INTO mp_work_data VALUES (29,1,'2010-12-15',1,1,1,1.0,'�¶��� ȸ�� ��� ����ǰ ���� ����̺�Ʈ');
INSERT INTO mp_work_data VALUES (30,1,'2010-12-15',1,1,1,1.0,'NCSI �������� �˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (31,1,'2010-12-16',1,2,1,0.5,'������ ���ޱ� ��� �ȳ� �˾� (���)');
INSERT INTO mp_work_data VALUES (32,1,'2010-12-16',1,2,1,0.5,'�Ե���ȭȦ ����ȳ� ������ ����');
INSERT INTO mp_work_data VALUES (33,1,'2010-12-16',1,1,1,0.5,'�������� �Ե������� ������');
INSERT INTO mp_work_data VALUES (34,1,'2010-12-16',1,1,1,1.0,'������ ���ϸ��� �Ͻ����� �ȳ� �˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (35,1,'2010-12-16',1,1,1,3.0,'���� ������ �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (36,1,'2010-12-16',1,1,1,1.0,'����ǰ+������ ���ϸ��� DM �ڵ���û');
INSERT INTO mp_work_data VALUES (37,1,'2010-12-17',1,2,1,0.5,'�뱸���� �˾�');
INSERT INTO mp_work_data VALUES (38,1,'2010-12-17',1,2,1,0.5,'ũ�������� �ε��� �ڵ� ����');
INSERT INTO mp_work_data VALUES (39,1,'2010-12-21',1,2,1,1.0,'�뱸���� �ָ�����ǰ�̺�Ʈ');
INSERT INTO mp_work_data VALUES (40,1,'2010-12-22',1,2,1,1.0,'����Ʈ�� ��ȭ�� �ڵ�');
INSERT INTO mp_work_data VALUES (41,1,'2010-12-22',1,2,1,1.0,'������������ ������ DM �ڵ�');
INSERT INTO mp_work_data VALUES (42,1,'2010-12-22',1,1,1,1.0,'��Ʈ���Ĵ� �ʴ�����帳�ϴ�');
INSERT INTO mp_work_data VALUES (43,1,'2010-12-22',1,1,1,0.5,'�ϴ�Ǫ�� ����� �ٷΰ��� ����');
INSERT INTO mp_work_data VALUES (44,1,'2010-12-23',1,2,1,0.5,'�¶��� ȸ�� ����ǰ �˾� �ڵ�');
INSERT INTO mp_work_data VALUES (45,1,'2010-12-23',1,2,1,1.0,'����ǰ+������ ���ϸ��� DM �ڵ�');
INSERT INTO mp_work_data VALUES (46,1,'2010-12-23',1,1,1,0.5,'������ �Ե���ǰ�� �ڵ���û');
INSERT INTO mp_work_data VALUES (47,1,'2010-12-24',1,2,1,0.5,'��ȭ�� �����ȳ� �˾�');
INSERT INTO mp_work_data VALUES (48,1,'2010-12-27',1,2,1,1.0,'����귣�� ���� �ڵ�');
INSERT INTO mp_work_data VALUES (49,1,'2010-12-27',1,1,1,1.0,'�Ƶ� 2010��÷��ǥ');
INSERT INTO mp_work_data VALUES (50,1,'2010-12-27',1,1,1,1.5,'������������Ʈ ��ǰ ������! �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (51,1,'2010-12-28',1,1,1,0.5,'����Ʈ�� ��ȭ�� ������ ����');
INSERT INTO mp_work_data VALUES (52,1,'2010-12-28',1,1,1,0.5,'IR �����ڷ� ���� ��ü');
INSERT INTO mp_work_data VALUES (53,1,'2010-12-29',1,1,1,0.5,'õ���� Ȩ������ �ڵ����� �۾� ��û');
INSERT INTO mp_work_data VALUES (54,1,'2010-12-29',1,2,1,0.5,'2011 �Ź��� ��� �˷��帳�ϴ� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (55,1,'2010-12-30',1,2,1,2.0,'���ؼҸ� ��� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (56,1,'2010-12-30',1,2,1,0.5,'��ȭ�� �����ȳ� �˾�');
INSERT INTO mp_work_data VALUES (57,1,'2010-12-30',1,2,1,0.5,'������ ������� �ڵ� ����');
INSERT INTO mp_work_data VALUES (58,1,'2010-12-30',1,1,1,0.5,'�����ȳ��˾� ����');
INSERT INTO mp_work_data VALUES (59,1,'2010-12-30',1,1,1,0.5,'NCSI �������� �˾� �Խ����� ��û');
INSERT INTO mp_work_data VALUES (60,1,'2010-12-30',1,1,1,2.0,'���Ե�N ��� �˾� �� ��ȭ��/��ȭ�� ��ư �߰� �ڵ���û');
INSERT INTO mp_work_data VALUES (61,1,'2010-12-30',1,1,1,0.5,'������ ������� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (62,1,'2010-12-31',1,2,1,2.0,'������ ���ϸ��� ���� �ߴ����� ���� �ڵ� ����');
INSERT INTO mp_work_data VALUES (63,1,'2010-12-31',1,2,1,0.5,'������ ������� �ڵ� ����');
INSERT INTO mp_work_data VALUES (64,1,'2010-12-02',1,2,1,1.5,'12�� 1�� ����DM');
INSERT INTO mp_work_data VALUES (65,1,'2010-12-09',1,2,1,1.5,'12�� 2�� ����DM');
INSERT INTO mp_work_data VALUES (66,1,'2010-12-16',1,2,1,1.5,'12�� 3�� ����DM');
INSERT INTO mp_work_data VALUES (67,1,'2010-12-23',1,2,1,1.5,'12�� 4�� ����DM');
INSERT INTO mp_work_data VALUES (68,1,'2010-12-30',1,2,1,1.5,'12�� 5�� ����DM');
INSERT INTO mp_work_data VALUES (69,1,'2010-12-01',2,2,1,0.5,'�ϳ����� ������ �ڵ� ����');
INSERT INTO mp_work_data VALUES (70,1,'2010-12-01',2,1,1,2.0,'����Ʈ�����̺�Ʈ ��ܳ׺񿵿� ������û');
INSERT INTO mp_work_data VALUES (71,1,'2010-12-02',2,1,1,0.5,'�������̺�Ʈ ��÷�ڹ�ǥ ������û');
INSERT INTO mp_work_data VALUES (72,1,'2010-12-02',2,1,1,1.0,'MVG �̺�Ʈ �ڵ� ������û');
INSERT INTO mp_work_data VALUES (73,1,'2010-12-02',2,1,1,0.5,'������ �̺�Ʈ �˾��ڵ���û');
INSERT INTO mp_work_data VALUES (74,1,'2010-12-02',2,1,1,0.5,'�Ե�����Ʈ �׺� ������û');
INSERT INTO mp_work_data VALUES (75,1,'2010-12-02',2,1,1,0.5,'���⼼�� ������û');
INSERT INTO mp_work_data VALUES (76,1,'2010-12-02',2,1,1,0.5,'�ű԰����̺�Ʈ ������ �ڵ�������û');
INSERT INTO mp_work_data VALUES (77,1,'2010-12-02',2,2,1,1.0,'���̿� ������ �ʴ������ �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (78,1,'2010-12-02',2,2,1,2.0,'�ް��̺�Ʈ 10�� �ڵ�');
INSERT INTO mp_work_data VALUES (79,1,'2010-12-02',2,2,1,2.0,'Ʈ������ ��ǰ�� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (80,1,'2010-12-02',2,2,1,0.5,'������ �ڵ� ����');
INSERT INTO mp_work_data VALUES (81,1,'2010-12-02',2,2,1,2.0,'ĳ�ù�����Ʈ ��Ī ����');
INSERT INTO mp_work_data VALUES (82,1,'2010-12-03',2,1,1,0.5,'��ȸ���Բ� 13000�� ���� �˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (83,1,'2010-12-03',2,1,1,1.0,'��õ���� ������ ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (84,1,'2010-12-03',2,1,1,0.5,'13,000�� ���� �̺�Ʈ �˾� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (85,1,'2010-12-03',2,1,1,0.5,'����Ʈ�̺�Ʈ������ ��� �׺񿵿� ����');
INSERT INTO mp_work_data VALUES (86,1,'2010-12-03',2,1,1,0.5,'��õ���� ������ ���� �̺�Ʈ ������û');
INSERT INTO mp_work_data VALUES (87,1,'2010-12-06',2,1,1,0.5,'���⼼�� ������û');
INSERT INTO mp_work_data VALUES (88,1,'2010-12-06',2,1,1,0.5,'12��1���� DM ������û');
INSERT INTO mp_work_data VALUES (89,1,'2010-12-06',2,2,1,1.0,'����� ���� ���� ���� �ڽ� �ڵ�');
INSERT INTO mp_work_data VALUES (90,1,'2010-12-06',2,2,1,2.0,'�������� �˸��� ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (91,1,'2010-12-06',2,2,1,0.5,'�ٺ���� ���ſ��̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (92,1,'2010-12-07',2,2,1,1.0,'�Լҹ����� �̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (93,1,'2010-12-07',2,1,1,0.5,'��_12��8�� �÷�Ƽ�� dm ������û');
INSERT INTO mp_work_data VALUES (94,1,'2010-12-08',2,1,1,1.5,'12�� 10�� ù���� DM �ڵ���û');
INSERT INTO mp_work_data VALUES (95,1,'2010-12-08',2,1,1,1.0,'12��10�� ù���� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (96,1,'2010-12-08',2,1,1,0.5,'�ϳ����������� url����');
INSERT INTO mp_work_data VALUES (97,1,'2010-12-08',2,2,1,0.5,'�����˾� ����');
INSERT INTO mp_work_data VALUES (98,1,'2010-12-09',2,2,1,2.0,'����ī�� ĳ�ù� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (99,1,'2010-12-09',2,2,1,1.0,'���� �Ҹ�������ּ��� �̺�Ʈ ���� ����Ƽ ����');
INSERT INTO mp_work_data VALUES (100,1,'2010-12-09',2,2,1,1.0,'������ ��� �ȳ� �˾� �۾�');
INSERT INTO mp_work_data VALUES (101,1,'2010-12-09',2,1,1,1.0,'���� ���� ����ǰ ���� �̺�Ʈ ���ۿ�û');
INSERT INTO mp_work_data VALUES (102,1,'2010-12-09',2,1,1,0.5,'����ī�� ĳ�ù� �̺�Ʈ ������û');
INSERT INTO mp_work_data VALUES (103,1,'2010-12-09',2,1,1,1.0,'�÷�Ƽ�� �α��� �˾� ����');
INSERT INTO mp_work_data VALUES (104,1,'2010-12-09',2,1,1,0.5,'12��10�� ù����DM������û');
INSERT INTO mp_work_data VALUES (105,1,'2010-12-10',2,1,1,0.5,'12��10�� ù����dm �ڵ�������û');
INSERT INTO mp_work_data VALUES (106,1,'2010-12-10',2,1,1,1.5,'12��13�� ���� �ڵ� ��û');
INSERT INTO mp_work_data VALUES (107,1,'2010-12-10',2,1,1,0.5,'12��13�� ���� dm �ڵ�������û');
INSERT INTO mp_work_data VALUES (108,1,'2010-12-10',2,1,1,0.5,'12��13�� ���� dm �ڵ�������û');
INSERT INTO mp_work_data VALUES (109,1,'2010-12-10',2,1,1,0.5,'�Ե�����Ʈ �̺�Ʈ ��� ��ũ ����');
INSERT INTO mp_work_data VALUES (110,1,'2010-12-14',2,2,1,1.0,'���� ��� ���ſ� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (111,1,'2010-12-16',2,2,1,3.0,'�ȳ����� ��� ȫ���̺�Ʈ');
INSERT INTO mp_work_data VALUES (112,1,'2010-12-16',2,1,1,0.5,'21���� ����dm ������û');
INSERT INTO mp_work_data VALUES (113,1,'2010-12-16',2,1,1,0.5,'21���� DM ������û');
INSERT INTO mp_work_data VALUES (114,1,'2010-12-17',2,2,1,0.5,'���ȸ�������� ��ǰ url����');
INSERT INTO mp_work_data VALUES (115,1,'2010-12-17',2,2,1,0.5,'���������� �̹��� ����');
INSERT INTO mp_work_data VALUES (116,1,'2010-12-21',2,2,1,1.0,'���ǼҸ� �̺�Ʈ ������ ����');
INSERT INTO mp_work_data VALUES (117,1,'2010-12-21',2,2,1,3.0,'�������� ���ſ� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (118,1,'2010-12-22',2,2,1,0.5,'����Ʈ ���̹� �̺�Ʈ �˾�');
INSERT INTO mp_work_data VALUES (119,1,'2010-12-22',2,2,1,3.0,'���� ������ ��ȯ �̺�Ʈ');
INSERT INTO mp_work_data VALUES (120,1,'2010-12-22',2,1,1,2.0,'�Ե�����Ʈ�����߰�');
INSERT INTO mp_work_data VALUES (121,1,'2010-12-22',2,1,1,1.5,'���ǼҸ� ����Ƽ ������û');
INSERT INTO mp_work_data VALUES (122,1,'2010-12-22',2,1,1,1.0,'��Ʈ�ν�Ƽ ���ſ��̺�Ʈ ������û');
INSERT INTO mp_work_data VALUES (123,1,'2010-12-22',2,1,1,1.0,'�Ե������ �йи�����Ʈ �߰���Ͽ�û');
INSERT INTO mp_work_data VALUES (124,1,'2010-12-23',2,2,1,1.0,'1�� �ϳ����� ���� �ڵ���û');
INSERT INTO mp_work_data VALUES (125,1,'2010-12-23',2,2,1,0.5,'�ű԰��� ù���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (126,1,'2010-12-23',2,2,1,1.0,'1�� �ƽþƳ� ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (127,1,'2010-12-23',2,1,1,0.5,'ù�����̺�Ʈ ��ũ ����');
INSERT INTO mp_work_data VALUES (128,1,'2010-12-24',2,1,1,0.5,'12�� 28�� ���� DM������û');
INSERT INTO mp_work_data VALUES (129,1,'2010-12-27',2,2,1,3.0,'���Ҵٸ� �ٽ��ѹ� �̺�Ʈ ��ǥ �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (130,1,'2010-12-27',2,1,1,1.5,'���� ���ſ� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (131,1,'2010-12-27',2,1,1,0.5,'12�� 28�� ���� DM ������米ü��û');
INSERT INTO mp_work_data VALUES (132,1,'2010-12-28',2,1,1,3.0,'�ų� ����, Ȳ���䳢�� ��ƶ� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (133,1,'2010-12-28',2,1,1,1.0,'��ȯ�� ��ȣ �ڵ����� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (134,1,'2010-12-28',2,1,1,2.0,'�����̺�Ʈ');
INSERT INTO mp_work_data VALUES (135,1,'2010-12-28',2,1,1,3.0,'������� �������ο��� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (136,1,'2010-12-29',2,2,1,0.5,'���� �˾� ����');
INSERT INTO mp_work_data VALUES (137,1,'2010-12-29',2,2,1,1.0,'ȸ������ �ű� ����');
INSERT INTO mp_work_data VALUES (138,1,'2010-12-29',2,2,1,0.5,'ȸ����� ����ȳ� ������ �ڵ�');
INSERT INTO mp_work_data VALUES (139,1,'2010-12-29',2,1,1,2.0,'1��1�� ��� �׺� �ڵ���û');
INSERT INTO mp_work_data VALUES (140,1,'2010-12-30',2,2,1,0.5,'������� �ε��� ������ ����');
INSERT INTO mp_work_data VALUES (141,1,'2010-12-30',2,2,1,0.5,'���� ��� �׺� �ڵ�');
INSERT INTO mp_work_data VALUES (142,1,'2010-12-30',2,2,1,2.0,'ȸ����� ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (143,1,'2010-12-30',2,2,1,0.5,'������� �������ο��� �̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (144,1,'2010-12-30',2,2,1,1.0,'���� DM 3�� �ڵ� ����');
INSERT INTO mp_work_data VALUES (145,1,'2010-12-31',2,2,1,1.0,'�Ե�����Ʈ&������ �������� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (146,1,'2010-12-31',2,2,1,0.5,'������� �ε��� ������_����2');
INSERT INTO mp_work_data VALUES (147,1,'2010-12-31',2,2,1,0.5,'ȸ������ ����_02');
INSERT INTO mp_work_data VALUES (148,1,'2010-12-31',2,2,1,0.5,'ȸ����޺��� �ȳ������� �ڵ�');
INSERT INTO mp_work_data VALUES (149,1,'2010-12-31',2,1,1,0.5,'1��3�� ���� dm ������û');
INSERT INTO mp_work_data VALUES (150,1,'2010-12-31',2,1,1,0.5,'1�� 4���� dm ������û');
INSERT INTO mp_work_data VALUES (151,1,'2010-12-31',2,1,1,1.0,'�ϳ����� ������ ���� �Խõ� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (152,1,'2010-12-31',2,1,1,0.5,'1��3�� ���� dm ������û');
INSERT INTO mp_work_data VALUES (153,1,'2010-12-03',2,2,1,1.5,'12������ ����DM');
INSERT INTO mp_work_data VALUES (154,1,'2010-12-13',2,2,1,1.5,'12��15���� �÷�Ƽ��DM');
INSERT INTO mp_work_data VALUES (155,1,'2010-12-20',2,2,1,1.5,'12��25���� ������ȯDM');
INSERT INTO mp_work_data VALUES (156,1,'2010-12-21',2,2,1,1.5,'12��23���� �÷�Ƽ��DM');
INSERT INTO mp_work_data VALUES (157,1,'2010-12-21',2,2,1,1.5,'12��23���� �籸��DM');
INSERT INTO mp_work_data VALUES (158,1,'2010-12-22',2,2,1,1.5,'12��23���� ���ȸ��DM');
INSERT INTO mp_work_data VALUES (159,1,'2010-12-24',2,2,1,1.5,'12��28���� ����DM');
INSERT INTO mp_work_data VALUES (160,1,'2010-12-30',2,2,1,1.5,'1��3���� ����DM');
INSERT INTO mp_work_data VALUES (161,1,'2010-12-31',2,2,1,1.5,'1��4���� ��޺�DM');
INSERT INTO mp_work_data VALUES (162,1,'2010-12-02',3,2,1,2.0,'�ް��̺�Ʈ 10��_���ڵ��� ���� ������ ����');
INSERT INTO mp_work_data VALUES (163,1,'2010-12-02',3,1,1,2.0,'12�� ���⼼��');
INSERT INTO mp_work_data VALUES (164,1,'2010-12-07',3,2,1,1.0,'�ֹ����������� �ڵ�');
INSERT INTO mp_work_data VALUES (165,1,'2010-12-08',3,2,1,0.5,'������������ �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (166,1,'2010-12-08',3,1,1,2.5,'����_�ܿ� ���� �ݿ�');
INSERT INTO mp_work_data VALUES (167,1,'2010-12-09',3,1,1,2.0,'�����̺�Ʈ �׺���̼� �ڵ� ��û (������ �ڷ� ÷��)');
INSERT INTO mp_work_data VALUES (168,1,'2010-12-09',3,2,1,0.5,'�α��� �˾� �ڵ�');
INSERT INTO mp_work_data VALUES (169,1,'2010-12-09',3,2,1,0.5,'������ �������� ����_��ư �߰�');
INSERT INTO mp_work_data VALUES (170,1,'2010-12-15',3,1,1,1.5,'12�� ���� DM - 1��_�߰��߼�');
INSERT INTO mp_work_data VALUES (171,1,'2010-12-16',3,2,1,1.0,'���η��̾��˾� �ڵ�');
INSERT INTO mp_work_data VALUES (172,1,'2010-12-17',3,2,1,0.5,'��ū ��������');
INSERT INTO mp_work_data VALUES (173,1,'2010-12-17',3,2,1,0.5,'�α��� �˾� ����');
INSERT INTO mp_work_data VALUES (174,1,'2010-12-22',3,1,1,1.0,'�Ե������ ���޻� �߰�_�⸰��ǰ');
INSERT INTO mp_work_data VALUES (175,1,'2010-12-23',3,1,1,2.5,'1�ֳ� ���_���� ����ũ ���� ������');
INSERT INTO mp_work_data VALUES (176,1,'2010-12-23',3,1,1,1.5,'���� �Ҹ� �ȳ� �˾�');
INSERT INTO mp_work_data VALUES (177,1,'2010-12-24',3,2,1,3.0,'������ ��ǰ ����̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (178,1,'2010-12-24',3,2,1,1.0,'��� & ù���� ���� �ڵ�');
INSERT INTO mp_work_data VALUES (179,1,'2010-12-27',3,2,1,1.0,'���Ͻų� ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (180,1,'2010-12-29',3,2,1,0.5,'������ ������ ����');
INSERT INTO mp_work_data VALUES (181,1,'2010-12-29',3,2,1,0.5,'�������� ���� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (182,1,'2010-12-30',3,2,1,0.5,'1�ֳ���_Ư������ ������ �� ���� �̺�Ʈ_����');
INSERT INTO mp_work_data VALUES (183,1,'2010-12-31',3,2,1,0.5,'2011 �����λ� �˾� ����');
INSERT INTO mp_work_data VALUES (184,1,'2010-12-03',3,2,1,1.5,'12��8���� ����DM');
INSERT INTO mp_work_data VALUES (185,1,'2010-12-20',3,2,1,1.5,'12��22���� ����DM');
INSERT INTO mp_work_data VALUES (186,1,'2010-12-27',3,2,1,1.5,'12��28���� �����Ҹ�DM');
INSERT INTO mp_work_data VALUES (187,1,'2010-12-01',4,1,1,2.0,'ũ�������� Ʈ�� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (188,1,'2010-12-02',4,2,1,0.5,'������ �ݹ��� �ʹ��� �̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (189,1,'2010-12-02',4,2,1,1.5,'�������� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (190,1,'2010-12-02',4,2,1,2.0,'�ް��̺�Ʈ 10��_���ڵ��� ���� ������ ����');
INSERT INTO mp_work_data VALUES (191,1,'2010-12-10',4,2,1,1.0,'����ī�� ĳ�ù� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (192,1,'2010-12-15',4,1,1,1.5,'������� ����Ÿ�� �̺�Ʈ ��1�� ��÷�ڹ�ǥ �ڵ� ��û');
INSERT INTO mp_work_data VALUES (193,1,'2010-12-17',4,1,1,1.0,'3,6,9 ũ������ ��÷�ڹ�ǥ �ڵ��� �Ƿ��մϴ�.');
INSERT INTO mp_work_data VALUES (194,1,'2010-12-20',4,1,1,1.0,'������4 ��÷�� ��ǥ���� ���� �߰��۾��Դϴ�.');
INSERT INTO mp_work_data VALUES (195,1,'2010-12-20',4,1,1,0.5,'��÷�ڹ�ǥ ���������� ���� �߰���');
INSERT INTO mp_work_data VALUES (196,1,'2010-12-21',4,1,1,1.5,'12�� 22���� DM �ڵ� ��û�帳�ϴ�.');
INSERT INTO mp_work_data VALUES (197,1,'2010-12-21',4,1,1,1.5,'�����Ҹ�Ⱓ �����');
INSERT INTO mp_work_data VALUES (198,1,'2010-12-21',4,2,1,0.5,'����Ʈ���̹� �̺�Ʈ�� �ڵ�');
INSERT INTO mp_work_data VALUES (199,1,'2010-12-22',4,2,1,0.5,'�ٽ�ã�� �̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (200,1,'2010-12-22',4,1,1,1.0,'Ǫ�� �⸰��ǰ ����� �߰���');
INSERT INTO mp_work_data VALUES (201,1,'2010-12-29',4,1,1,1.5,'����������̺�Ʈ �ڵ� ��û');
INSERT INTO mp_work_data VALUES (202,1,'2010-12-30',4,2,1,1.0,'1�� ������ �ڵ�');
INSERT INTO mp_work_data VALUES (203,1,'2010-12-30',4,2,1,0.5,'�����̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (204,1,'2010-12-31',4,1,1,1.0,'��� ��ü �ڵ� ��û');
INSERT INTO mp_work_data VALUES (205,1,'2010-12-08',4,2,1,1.5,'12��9���� DM');
INSERT INTO mp_work_data VALUES (206,1,'2010-12-02',5,2,1,0.5,'�����˾���ü');
INSERT INTO mp_work_data VALUES (207,1,'2010-12-07',5,1,1,1.5,'�߹��̺�Ʈ ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (208,1,'2010-12-10',5,2,1,1.0,'�ܿ���� ��� �� �� ��ü');
INSERT INTO mp_work_data VALUES (209,1,'2010-12-10',5,1,1,1.5,'12/13�߼� �߹�DM �ڵ���û');
INSERT INTO mp_work_data VALUES (210,1,'2010-12-13',5,1,1,10.0,'�ܿ���� ��� �� �� ��ü��û');
INSERT INTO mp_work_data VALUES (211,1,'2010-12-13',5,1,1,1.0,'�йи��ܼ�Ʈ ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (212,1,'2010-12-14',5,2,1,1.0,'����Ʈ�ڸ��� ����');
INSERT INTO mp_work_data VALUES (213,1,'2010-12-14',5,1,1,2.0,'����ü �ڵ����� ��û');
INSERT INTO mp_work_data VALUES (214,1,'2010-12-15',5,1,1,1.5,'���� �Ϻ�����û ����߰���û');
INSERT INTO mp_work_data VALUES (215,1,'2010-12-15',5,1,1,1.0,'����Ʈ�� ������û');
INSERT INTO mp_work_data VALUES (216,1,'2010-12-21',5,1,1,0.5,'����_�Ϻ�����û��� ��ü��û');
INSERT INTO mp_work_data VALUES (217,1,'2010-12-22',5,1,1,0.5,'��ũ�ּ� ������û');
INSERT INTO mp_work_data VALUES (218,1,'2010-12-22',5,1,1,0.5,'���޻�_�⸰��ǰ �߰���û');
INSERT INTO mp_work_data VALUES (219,1,'2010-12-23',5,1,1,0.5,'��ũ ���� ��û');
INSERT INTO mp_work_data VALUES (220,1,'2010-12-23',5,1,1,1.0,'���� �ϴ��˾� ��ü��û');
INSERT INTO mp_work_data VALUES (221,1,'2010-12-24',5,1,1,1.0,'�������� ���� ��û');
INSERT INTO mp_work_data VALUES (222,1,'2010-12-28',5,1,1,1.5,'�߹� �ؽ�Ʈ �ڵ�������û');
INSERT INTO mp_work_data VALUES (223,1,'2010-12-28',5,1,1,1.0,'��������� �ڵ� ��û');
INSERT INTO mp_work_data VALUES (224,1,'2010-12-31',5,1,1,3.0,'�⺯��, �˾� �� �ڵ���û');
INSERT INTO mp_work_data VALUES (225,1,'2010-12-09',5,2,1,1.5,'12��12���� ����DM');
INSERT INTO mp_work_data VALUES (226,1,'2010-12-03',5,1,1,0.5,'[�Ϲ�] �Ե����ͳ� �鼼�� ��ũ ����');
INSERT INTO mp_work_data VALUES (227,1,'2010-12-03',5,1,1,1.5,'[�Ϲ�] �̺�Ʈī�޷α�');
INSERT INTO mp_work_data VALUES (228,1,'2010-12-07',5,2,1,1.0,'[�Ϲ�] �����̹��� �� ��ܸ޴����, GNB�޴���� ��ü');
INSERT INTO mp_work_data VALUES (229,1,'2010-12-09',5,2,1,0.5,'[�Ϲ�] �Ϲ��ΰ� ��ü');
INSERT INTO mp_work_data VALUES (230,1,'2010-12-13',5,1,1,2.0,'[�Ϲ�] ���ϸŰ��� ȸ����� ���');
INSERT INTO mp_work_data VALUES (231,1,'2010-12-13',5,2,1,0.5,'[�Ϲ�] �ʹ� 12��ȣ');
INSERT INTO mp_work_data VALUES (232,1,'2010-12-15',5,1,1,2.0,'[�Ϲ�] �ѷ���Ÿ������? �йи��ܼ�Ʈ������ ������û');
INSERT INTO mp_work_data VALUES (233,1,'2010-12-15',5,1,1,1.5,'[�Ϲ�] ����������_ �����޴� ���� ����');
INSERT INTO mp_work_data VALUES (234,1,'2010-12-20',5,2,1,1.0,'[�Ϲ�] �� ������ ��ȭ��ȣ �� �����ð� ����');
INSERT INTO mp_work_data VALUES (235,1,'2010-12-22',5,2,1,1.0,'[�Ϲ�] ���������ð� �� ��ǥ��ȭ ����');
INSERT INTO mp_work_data VALUES (236,1,'2010-12-24',5,2,1,1.0,'[�Ϲ�] ���� ����ó �� �� ����');
INSERT INTO mp_work_data VALUES (237,1,'2010-12-24',5,2,1,1.0,'[�Ϲ�] ��������� �̹��� ��ü');
INSERT INTO mp_work_data VALUES (238,1,'2010-12-29',5,1,1,2.0,'[�Ϲ�] �� ���� ����ȳ��� ��ü');
INSERT INTO mp_work_data VALUES (239,1,'2010-12-31',5,1,1,0.5,'[�Ϲ�] ���ϸŰ���ȸ������ �̹��� ��ü');
INSERT INTO mp_work_data VALUES (240,1,'2010-12-03',5,2,1,2.0,'[�Ϲ�] 12��6�� �����, ���ڸ���');
INSERT INTO mp_work_data VALUES (241,1,'2010-12-16',5,2,1,2.0,'[�Ϲ�] 12��20�� �����, ���ڸ���');
INSERT INTO mp_work_data VALUES (242,1,'2010-12-01',6,2,1,1.0,'12���������̺�Ʈ�ڵ�');
INSERT INTO mp_work_data VALUES (243,1,'2010-12-21',6,2,1,2.0,'369�庸�� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (244,1,'2010-12-01',6,1,1,1.5,'12��1���� ���� DM �ڵ� ��û��');
INSERT INTO mp_work_data VALUES (245,1,'2010-12-02',6,1,1,1.0,'12�� 1�� �ָ�DM �ڵ� ��û��');
INSERT INTO mp_work_data VALUES (246,1,'2010-12-03',6,1,1,1.0,'ģ����õ�̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (247,1,'2010-12-03',6,1,1,4.0,'�Ե����� ����������� ����Ʈ����');
INSERT INTO mp_work_data VALUES (248,1,'2010-12-06',6,1,1,3.0,'�⼮üũ�̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (249,1,'2010-12-06',6,1,1,0.5,'12��������� DM �ڵ���û');
INSERT INTO mp_work_data VALUES (250,1,'2010-12-08',6,1,1,2.0,'�Ｎ�����̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (251,1,'2010-12-08',6,1,1,1.0,'ģ����õDM �ڵ���û');
INSERT INTO mp_work_data VALUES (252,1,'2010-12-09',6,1,1,1.0,'12�� 2�� �ָ�DM �ڵ� ��û');
INSERT INTO mp_work_data VALUES (253,1,'2010-12-10',6,1,1,1.0,'�Ե�������Ư��2��DM �ڵ���û');
INSERT INTO mp_work_data VALUES (254,1,'2010-12-10',6,1,1,1.0,'������Ư���ڵ������û');
INSERT INTO mp_work_data VALUES (255,1,'2010-12-23',6,1,1,1.0,'12�� 4�� �ָ�DM �ڵ� ��û��');
INSERT INTO mp_work_data VALUES (256,1,'2010-12-27',6,1,1,3.0,'���غ����⺯��');
INSERT INTO mp_work_data VALUES (257,1,'2010-12-28',6,1,1,1.5,'1���������̺�Ʈ');
INSERT INTO mp_work_data VALUES (258,1,'2010-12-01',6,2,1,1.0,'������Ư��������DM');
INSERT INTO mp_work_data VALUES (259,1,'2010-12-08',6,2,1,1.5,'12��2���� ����DM');
INSERT INTO mp_work_data VALUES (260,1,'2010-12-15',6,2,1,1.5,'12��3���� ����DM');
INSERT INTO mp_work_data VALUES (261,1,'2010-12-16',6,2,1,1.0,'12��3���� �ָ�DM');
INSERT INTO mp_work_data VALUES (262,1,'2010-12-22',6,2,1,1.5,'12��4���� ����DM');
INSERT INTO mp_work_data VALUES (263,1,'2010-12-29',6,2,1,1.5,'12��5���� ����DM');
INSERT INTO mp_work_data VALUES (264,1,'2010-12-30',6,2,1,1.0,'12��5���� �ָ�DM');
INSERT INTO mp_work_data VALUES (265,1,'2010-12-01',10,1,1,0.5,'DM �ڵ� ������û');
INSERT INTO mp_work_data VALUES (266,1,'2010-12-02',10,1,1,1.5,'������ ��Ÿ�� ��� �Ե�only - ����!');
INSERT INTO mp_work_data VALUES (267,1,'2010-12-29',10,1,1,1.5,'43ȣ ��ǰ�̹��� ���ε� ��û');
INSERT INTO mp_work_data VALUES (268,1,'2010-12-14',10,2,1,1.0,'�÷��� 42ȣ  DM');
INSERT INTO mp_work_data VALUES (269,1,'2010-12-08',11,2,1,0.5,'���� ���̳��� ����Ʈ ������Ʈ');
INSERT INTO mp_work_data VALUES (270,1,'2010-12-16',11,1,1,2.0,'����, �Ϲ� ������ ����');
INSERT INTO mp_work_data VALUES (271,1,'2010-12-01',12,1,1,1.0,'�Ŵ��� �ٿ�ε� ����÷�� ����');
INSERT INTO mp_work_data VALUES (272,1,'2010-12-03',12,1,1,1.0,'������ ������û');
INSERT INTO mp_work_data VALUES (273,1,'2010-12-10',12,1,1,1.0,'ǲ�Ϳ��� ������û �帳�ϴ�.');
INSERT INTO mp_work_data VALUES (274,1,'2010-12-02',7,1,1,1.5,'�ű�����_��õ�� ����');
INSERT INTO mp_work_data VALUES (275,1,'2010-12-10',7,1,1,1.0,'����� ��ũ ����');
INSERT INTO mp_work_data VALUES (276,1,'2010-12-20',7,1,1,1.5,'�ű����� ����_1��(�����)');
INSERT INTO mp_work_data VALUES (277,1,'2010-12-22',7,1,1,1.0,'����� ��ũ�߰�');
INSERT INTO mp_work_data VALUES (278,1,'2010-12-29',7,1,1,1.5,'�ű����� ����');
INSERT INTO mp_work_data VALUES (279,1,'2010-12-29',7,1,1,2.0,'��������ũ����_�˾�����');
INSERT INTO mp_work_data VALUES (280,1,'2010-12-30',7,2,1,1.0,'��������ũ����_�˾�����');
INSERT INTO mp_work_data VALUES (281,1,'2010-12-31',7,1,1,1.5,'����������/����Ʈ�� ����');
INSERT INTO mp_work_data VALUES (282,1,'2010-12-10',8,1,1,1.0,'ǲ�Ϳ��� ������û �帳�ϴ�.');
INSERT INTO mp_work_data VALUES (283,1,'2010-12-28',8,1,1,1.5,'������ ��÷�� ��ǥ �ڵ���û');
INSERT INTO mp_work_data VALUES (284,1,'2010-12-16',8,2,1,1.5,'12�� 16�� ����,����DM');
INSERT INTO mp_work_data VALUES (285,1,'2010-12-20',9,1,1,1.0,'�ű�����_1�� ��û�帳�ϴ�.(�����)');
INSERT INTO mp_work_data VALUES (286,1,'2010-12-29',9,1,1,1.0,'�ű� ���� ����');
INSERT INTO mp_work_data VALUES (287,1,'2010-11-01',1,1,1,1.0,'���ĸ��� �ϴ� Ǫ������ ����');
INSERT INTO mp_work_data VALUES (288,1,'2010-11-02',1,2,1,1.0,'��ȭ���� �˾� (28����)');
INSERT INTO mp_work_data VALUES (289,1,'2010-11-02',1,1,1,2.0,'31�ֳ� ��� \"�кҲ���\" �̺�Ʈ');
INSERT INTO mp_work_data VALUES (290,1,'2010-11-03',1,1,1,1.5,'���ǰ� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (291,1,'2010-11-03',1,1,1,1.0,'31�ֳ� ���м� ��ũ');
INSERT INTO mp_work_data VALUES (292,1,'2010-11-03',1,1,1,1.5,'��Ƽ�� ��̵��� ķ���� �̺�Ʈ, �����˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (293,1,'2010-11-04',1,1,1,1.5,'�ű�ȸ�� ����ǰ �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (294,1,'2010-11-04',1,1,1,0.5,'�����DC�� �޴� ���� ��û�� ��');
INSERT INTO mp_work_data VALUES (295,1,'2010-11-04',1,1,1,2.0,'31�ֳ� �������, ���ϸ޽��� ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (296,1,'2010-11-05',1,1,1,1.0,'���ǰ� ������ ��� �߰�');
INSERT INTO mp_work_data VALUES (297,1,'2010-11-05',1,1,1,1.0,'���̷��� ���� �ڵ���û');
INSERT INTO mp_work_data VALUES (298,1,'2010-11-08',1,1,1,0.5,'���̷��� ���� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (299,1,'2010-11-08',1,1,1,0.5,'11�� Ȩ������ �ű�ȸ�� ����ǰ �̺�Ʈ �˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (300,1,'2010-11-08',1,1,1,3.0,'������������ ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (301,1,'2010-11-08',1,1,1,1.0,'��ź��� Ʈ���� �̺�Ʈ ��÷��ǥ');
INSERT INTO mp_work_data VALUES (302,1,'2010-11-08',1,1,1,1.0,'�������� �� ���� ����');
INSERT INTO mp_work_data VALUES (303,1,'2010-11-08',1,1,1,2.0,'�׸��Ե� ĳ���� �ִϸ��̼�/ī�� ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (304,1,'2010-11-09',1,1,1,0.5,'�׸��Ե� ĳ���� �ִϸ��̼�/ī�� ������ �ڵ� ������û');
INSERT INTO mp_work_data VALUES (305,1,'2010-11-09',1,1,1,0.5,'���� �˾�');
INSERT INTO mp_work_data VALUES (306,1,'2010-11-09',1,1,1,0.5,'�ĵ� �е� �佺Ƽ�� �ڵ���û');
INSERT INTO mp_work_data VALUES (307,1,'2010-11-10',1,1,1,0.5,'����� Ÿ�� ���� �ܼ�Ʈ �������� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (308,1,'2010-11-10',1,1,1,0.5,'�ű�ȸ�� ����ǰ �̺�Ʈ �ڵ� ������û');
INSERT INTO mp_work_data VALUES (309,1,'2010-11-11',1,1,1,5.0,'��Ƹ�� �������� ��� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (310,1,'2010-11-11',1,1,1,0.5,'������ ���ϸ��� �Ͻ����� �ȳ� �˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (311,1,'2010-11-11',1,2,1,3.0,'������ UCC�̺�Ʈ');
INSERT INTO mp_work_data VALUES (312,1,'2010-11-12',1,2,1,1.0,'�뱸���� �˾�');
INSERT INTO mp_work_data VALUES (313,1,'2010-11-12',1,2,1,1.0,'VIP ���α׷� ����޴� ����');
INSERT INTO mp_work_data VALUES (314,1,'2010-11-12',1,2,1,0.5,'��ȭ�� �����ȳ� �˾�');
INSERT INTO mp_work_data VALUES (315,1,'2010-11-12',1,1,1,0.5,'�˾���û');
INSERT INTO mp_work_data VALUES (316,1,'2010-11-15',1,1,1,1.0,'��Ƹ�� �̺�Ʈ �ڵ�������û');
INSERT INTO mp_work_data VALUES (317,1,'2010-11-15',1,1,1,0.5,'����Ϲ�ȭ���� ��ǰ�� ���� ��ư ����');
INSERT INTO mp_work_data VALUES (318,1,'2010-11-16',1,2,1,0.5,'�Ե���ȭ������ UFO�� ��ƶ� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (319,1,'2010-11-16',1,2,1,0.5,'���� �˾�');
INSERT INTO mp_work_data VALUES (320,1,'2010-11-16',1,1,1,0.5,'31�ֳ� ���� ��Ʈ�� �����û');
INSERT INTO mp_work_data VALUES (321,1,'2010-11-16',1,1,1,1.0,'��Ƹ�� ������� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (322,1,'2010-11-16',1,1,1,2.0,'���ö��� �귣�� ��α�');
INSERT INTO mp_work_data VALUES (323,1,'2010-11-16',1,1,1,0.5,'������ ����� �̺�Ʈ ��÷��ǥ');
INSERT INTO mp_work_data VALUES (324,1,'2010-11-16',1,2,1,0.5,'������ ���ϸ��� �ڵ� ����');
INSERT INTO mp_work_data VALUES (325,1,'2010-11-18',1,2,1,0.5,'�λ꺻�� �˾�');
INSERT INTO mp_work_data VALUES (326,1,'2010-11-18',1,2,1,0.5,'�뱸���� �˾�');
INSERT INTO mp_work_data VALUES (327,1,'2010-11-18',1,1,1,0.5,'���� �˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (328,1,'2010-11-18',1,1,1,0.5,'����귣�� ���� �ڵ���û');
INSERT INTO mp_work_data VALUES (329,1,'2010-11-18',1,1,1,0.5,'���ö��� �귣�� ��α� ��� ��ũ�۾�');
INSERT INTO mp_work_data VALUES (330,1,'2010-11-18',1,1,1,0.5,'�Ե���ȭ������ UFO�� ��ƶ� �̺�Ʈ �ڵ�����, �˾���û');
INSERT INTO mp_work_data VALUES (331,1,'2010-11-18',1,2,1,0.5,'���ҽ�Ƽ�� �˾� (����ī�� �˾� �߰�)');
INSERT INTO mp_work_data VALUES (332,1,'2010-11-19',1,1,1,3.0,'��ȭȦ ���� ������ ���� ���� �۾���û');
INSERT INTO mp_work_data VALUES (333,1,'2010-11-19',1,1,1,2.0,'�귣�� ��α� ����޴�');
INSERT INTO mp_work_data VALUES (334,1,'2010-11-19',1,1,1,2.0,'��ȸ�� å�� ������ ����');
INSERT INTO mp_work_data VALUES (335,1,'2010-11-23',1,1,1,0.5,'�Ե���ǰ�� ���ȳ� ��ũ �ּ� ����');
INSERT INTO mp_work_data VALUES (336,1,'2010-11-23',1,2,1,0.5,'��ǰ�� �Ǹż� ����ó �߰�');
INSERT INTO mp_work_data VALUES (337,1,'2010-11-24',1,1,1,1.0,'������� �佺Ƽ�� (������, �˾�)');
INSERT INTO mp_work_data VALUES (338,1,'2010-11-24',1,2,1,1.0,'�罺���� ��ȭ �û�ȸ �ʴ���');
INSERT INTO mp_work_data VALUES (339,1,'2010-11-25',1,1,1,1.5,'��ȭȦ ���� ������ ���� ���� �۾���û');
INSERT INTO mp_work_data VALUES (340,1,'2010-11-25',1,1,1,0.5,'�귣�� ��α� ����Ʈ �׸�� �̹��� ����');
INSERT INTO mp_work_data VALUES (341,1,'2010-11-25',1,1,1,2.0,'�����̾����� ���� ���̶���Ʈ');
INSERT INTO mp_work_data VALUES (342,1,'2010-11-25',1,1,1,0.5,'�����̾����� �ָ����Ű� ����');
INSERT INTO mp_work_data VALUES (343,1,'2010-11-25',1,1,1,0.5,'���� �ؿܸ�ǰ ���Ż��� ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (344,1,'2010-11-25',1,1,1,0.5,'���� �ε��� �ڵ� ��û');
INSERT INTO mp_work_data VALUES (345,1,'2010-11-25',1,1,1,0.5,'���󸣴ٷ� ���� �˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (346,1,'2010-11-26',1,1,1,0.5,'����Ƽ�弥 �޴�(�귣��) ����');
INSERT INTO mp_work_data VALUES (347,1,'2010-11-26',1,1,1,0.5,'�罺���� �̺�Ʈ �ڵ�����');
INSERT INTO mp_work_data VALUES (348,1,'2010-11-26',1,1,1,0.5,'������� �佺Ƽ�� ������ ����(��ư��ũ)');
INSERT INTO mp_work_data VALUES (349,1,'2010-11-29',1,1,1,0.5,'����,����� �˾� ����');
INSERT INTO mp_work_data VALUES (350,1,'2010-11-30',1,1,1,3.0,'�Ե������ ���� ������ �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (351,1,'2010-11-30',1,1,1,0.5,'��ȭȦ �����Ұ� ����� ������ ���� ��û');
INSERT INTO mp_work_data VALUES (352,1,'2010-11-30',1,1,1,0.5,'���Ӱ��� �濵 ���� ���� ��ü');
INSERT INTO mp_work_data VALUES (353,1,'2010-11-30',1,1,1,0.5,'��ǰ�� ������ �߰�');
INSERT INTO mp_work_data VALUES (354,1,'2010-11-30',1,1,1,0.5,'11�� ������ �̺�Ʈ �˾� �Խ� �����û');
INSERT INTO mp_work_data VALUES (355,1,'2010-11-04',1,2,1,1.5,'11�� 1�� ����DM');
INSERT INTO mp_work_data VALUES (356,1,'2010-11-11',1,2,1,1.5,'11�� 2�� ����DM');
INSERT INTO mp_work_data VALUES (357,1,'2010-11-18',1,2,1,1.5,'11�� 3�� ����DM');
INSERT INTO mp_work_data VALUES (358,1,'2010-11-25',1,2,1,1.5,'11�� 4�� ����DM');
INSERT INTO mp_work_data VALUES (359,1,'2010-11-01',2,2,1,0.5,'5�ð����� ���̾��˾�');
INSERT INTO mp_work_data VALUES (360,1,'2010-11-01',2,1,1,0.5,'���� ��� �׺� �۾���û');
INSERT INTO mp_work_data VALUES (361,1,'2010-11-01',2,1,1,0.5,'���������ε� ���� �ڵ�');
INSERT INTO mp_work_data VALUES (362,1,'2010-11-01',2,1,1,0.5,'sk�ڸ�ũ�̺�Ʈ������ �ڵ�������û');
INSERT INTO mp_work_data VALUES (363,1,'2010-11-02',2,2,1,0.5,'���⼼�� ������ ��ũ����');
INSERT INTO mp_work_data VALUES (364,1,'2010-11-02',2,2,1,1.0,'�ܱ���Ư������ ����');
INSERT INTO mp_work_data VALUES (365,1,'2010-11-03',2,2,1,1.5,'����� ������� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (366,1,'2010-11-03',2,1,1,1.0,'�κ��� ���ſ� ������ ����');
INSERT INTO mp_work_data VALUES (367,1,'2010-11-04',2,1,1,0.5,'�ϳ����� ���������� �ڵ���û');
INSERT INTO mp_work_data VALUES (368,1,'2010-11-05',2,1,1,1.5,'�������� ���ſ� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (369,1,'2010-11-05',2,2,1,1.0,'�Ե� & 5�ð����� ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (370,1,'2010-11-08',2,1,1,1.0,'�κ��� ���ſ� ������û');
INSERT INTO mp_work_data VALUES (371,1,'2010-11-08',2,1,1,1.0,'5�ð����� ���̾��˾� �ڵ���û');
INSERT INTO mp_work_data VALUES (372,1,'2010-11-08',2,1,1,2.0,'���ι鼭 ������ ����');
INSERT INTO mp_work_data VALUES (373,1,'2010-11-08',2,1,1,1.5,'��� ���ſ��̺�Ʈ');
INSERT INTO mp_work_data VALUES (374,1,'2010-11-08',2,1,1,3.5,'���� �Ҹ��� ����ּ��� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (375,1,'2010-11-09',2,1,1,1.5,'�Ե�ī�� ����Ʈ ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (376,1,'2010-11-09',2,1,1,2.0,'�ް��̺�Ʈ 9�� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (377,1,'2010-11-09',2,1,1,0.5,'�������� ���ſ� �̺�Ʈ �˾� ����');
INSERT INTO mp_work_data VALUES (378,1,'2010-11-10',2,2,1,1.0,'�Ե�����Ʈ �ִ� 100% ĳ�ù� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (379,1,'2010-11-10',2,2,1,0.5,'ù���� �ű�ȸ�� 1������Ʈ ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (380,1,'2010-11-10',2,2,1,3.0,'�����ı� URL��� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (381,1,'2010-11-11',2,2,1,1.0,'�������� ���ſ� �̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (382,1,'2010-11-11',2,1,1,1.0,'FAQ �κ� ����');
INSERT INTO mp_work_data VALUES (383,1,'2010-11-11',2,1,1,0.5,'���� ���̾� �˾�');
INSERT INTO mp_work_data VALUES (384,1,'2010-11-11',2,1,1,0.5,'�Ե�ī�� ����Ʈ ���� �̺�Ʈ ������û');
INSERT INTO mp_work_data VALUES (385,1,'2010-11-11',2,1,1,1.0,'�Ե�����Ʈ �ε��� �׺� �ڵ���û');
INSERT INTO mp_work_data VALUES (386,1,'2010-11-11',2,1,1,0.5,'������� �ε��������� ����');
INSERT INTO mp_work_data VALUES (387,1,'2010-11-11',2,1,1,0.5,'�Ե�ī�� �̺�Ʈ ��ũ ������û');
INSERT INTO mp_work_data VALUES (388,1,'2010-11-12',2,1,1,1.0,'�������� �̺�Ʈ �ڵ�������û');
INSERT INTO mp_work_data VALUES (389,1,'2010-11-12',2,1,1,1.0,'���ؿ� ������ ���� ���̾� �˾� �߰�');
INSERT INTO mp_work_data VALUES (390,1,'2010-11-15',2,2,1,0.5,'����Ʈ ���� �׺� ����');
INSERT INTO mp_work_data VALUES (391,1,'2010-11-15',2,1,1,3.0,'������ �Ҹ��� ����ּ��� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (392,1,'2010-11-18',2,2,1,1.0,'�����м���ȭ�귣�� ������ �ڵ�');
INSERT INTO mp_work_data VALUES (393,1,'2010-11-18',2,1,1,1.5,'�̺�Ʈ������ ��ܳ׺� �ڵ���û');
INSERT INTO mp_work_data VALUES (394,1,'2010-11-19',2,2,1,1.0,'�м���ȭ/�ð� ���Ž� ȭ��ǰ ��� 50% ���� ����');
INSERT INTO mp_work_data VALUES (395,1,'2010-11-19',2,2,1,0.5,'�ֹ�/���� 2�ܰ� �ֹ����ۼ� ������ ����');
INSERT INTO mp_work_data VALUES (396,1,'2010-11-19',2,2,1,1.0,'��Ʈ�ξ�Ƽ ���ſ� �ڵ���û');
INSERT INTO mp_work_data VALUES (397,1,'2010-11-22',2,1,1,1.0,'������ �̺�Ʈ ��÷�ڹ�ǥ ��û');
INSERT INTO mp_work_data VALUES (398,1,'2010-11-23',2,1,1,0.5,'�ϳ����� ������ ������û');
INSERT INTO mp_work_data VALUES (399,1,'2010-11-23',2,1,1,0.5,'10�ֳ� ���������̺�Ʈ ��÷�ڹ�ǥ��û');
INSERT INTO mp_work_data VALUES (400,1,'2010-11-23',2,2,1,1.0,'MVG ��� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (401,1,'2010-11-24',2,2,1,2.0,'����ī�� �̺�Ʈ �ڵ�');
INSERT INTO mp_work_data VALUES (402,1,'2010-11-24',2,2,1,1.0,'���̾��˾� �ڵ�');
INSERT INTO mp_work_data VALUES (403,1,'2010-11-24',2,1,1,0.5,'10�ֳ� ���������̺�Ʈ ��÷�ڹ�ǥ �ڵ�������û');
INSERT INTO mp_work_data VALUES (404,1,'2010-11-25',2,1,1,0.5,'12�� �ϳ����� ���� �ڵ���û');
INSERT INTO mp_work_data VALUES (405,1,'2010-11-25',2,1,1,0.5,'�ϳ����� ������ ���� �Խõ� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (406,1,'2010-11-25',2,1,1,0.5,'�����÷�Ƽ�� ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (407,1,'2010-11-25',2,1,1,0.5,'���������ε� ���� �ڵ� ��û');
INSERT INTO mp_work_data VALUES (408,1,'2010-11-26',2,1,1,0.5,'12�� �ƽþƳ� ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (409,1,'2010-11-26',2,1,1,0.5,'���������̺�Ʈ ��÷�ڹ�ǥ');
INSERT INTO mp_work_data VALUES (410,1,'2010-11-29',2,1,1,0.5,'���������� ��ũ������û');
INSERT INTO mp_work_data VALUES (411,1,'2010-11-29',2,1,1,0.5,'����� �ȳ� ��ũ��ü ��û');
INSERT INTO mp_work_data VALUES (412,1,'2010-11-30',2,1,1,0.5,'���� �����ε� ���� 12����');
INSERT INTO mp_work_data VALUES (413,1,'2010-11-30',2,1,1,1.0,'������ ������û');
INSERT INTO mp_work_data VALUES (414,1,'2010-11-30',2,1,1,0.5,'�����ͳ��� ȸ����� ������û');
INSERT INTO mp_work_data VALUES (415,1,'2010-11-30',2,1,1,0.5,'��Ʈ�ν�Ƽ ���ſ��̺�Ʈ ��ư �߰���û');
INSERT INTO mp_work_data VALUES (416,1,'2010-11-30',2,1,1,1.5,'���� ���GNB���� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (417,1,'2010-11-30',2,1,1,2.0,'����Ʈ���� �̺�Ʈ ��� �׺񿵿� ������û');
INSERT INTO mp_work_data VALUES (418,1,'2010-11-30',2,1,1,2.0,'10�ֳ� ��� �ű԰���,ù���� ��÷�ڹ�ǥ');
INSERT INTO mp_work_data VALUES (419,1,'2010-11-01',2,2,1,1.5,'11��3���� ����DM');
INSERT INTO mp_work_data VALUES (420,1,'2010-11-01',2,2,1,0.5,'11��2���� �籸��, ù����DM ����');
INSERT INTO mp_work_data VALUES (421,1,'2010-11-04',2,1,1,0.5,'11�� 1���� DM ����');
INSERT INTO mp_work_data VALUES (422,1,'2010-11-05',2,2,1,1.5,'11��8���� ����DM');
INSERT INTO mp_work_data VALUES (423,1,'2010-11-11',2,1,1,1.5,'11�� 15���� ����DM');
INSERT INTO mp_work_data VALUES (424,1,'2010-11-12',2,2,1,1.5,'11��17���� ����DM');
INSERT INTO mp_work_data VALUES (425,1,'2010-11-12',2,2,1,0.5,'11��15���� ����DM ����');
INSERT INTO mp_work_data VALUES (426,1,'2010-11-12',2,2,1,0.5,'11��17���� �÷�Ƽ��DM ����');
INSERT INTO mp_work_data VALUES (427,1,'2010-11-15',2,2,1,1.5,'11��17���� ���ȸ��DM');
INSERT INTO mp_work_data VALUES (428,1,'2010-11-16',2,1,1,0.5,'11�� 17���� DM ����');
INSERT INTO mp_work_data VALUES (429,1,'2010-11-22',2,2,1,1.5,'11��24���� ����DM');
INSERT INTO mp_work_data VALUES (430,1,'2010-11-23',2,1,1,0.5,'11�� 24���� ����DM ����');
INSERT INTO mp_work_data VALUES (431,1,'2010-11-26',2,2,1,1.5,'11��29���� ����DM');
INSERT INTO mp_work_data VALUES (432,1,'2010-11-26',2,2,1,1.0,'12��1���� �÷�Ƽ�� DM 2��');
INSERT INTO mp_work_data VALUES (433,1,'2010-11-04',3,2,1,0.5,'�¶��μ� �귣�� �߰�');
INSERT INTO mp_work_data VALUES (434,1,'2010-11-04',3,2,1,1.0,'���ȸ�� ��� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (435,1,'2010-11-04',3,1,1,2.0,'ûø�� ��� ����');
INSERT INTO mp_work_data VALUES (436,1,'2010-11-04',3,1,1,1.0,'�������� ������ �ڵ� ��û(�������ڷ� ÷��)');
INSERT INTO mp_work_data VALUES (437,1,'2010-11-09',3,1,1,2.0,'�ް��̺�Ʈ 9��_Ǫ�� �θ�ƽ Ŀ�� ����');
INSERT INTO mp_work_data VALUES (438,1,'2010-11-12',3,2,1,1.0,'�ⱹ 7���� ���������� ���� �߼� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (439,1,'2010-11-16',3,2,1,1.0,'11�� 3���� �ָ����� ����');
INSERT INTO mp_work_data VALUES (440,1,'2010-11-25',3,1,1,2.0,'ũ�������� Ʈ���� ����������');
INSERT INTO mp_work_data VALUES (441,1,'2010-11-25',3,2,1,3.0,'12������ (ũ��������, ù����, ���������)');
INSERT INTO mp_work_data VALUES (442,1,'2010-11-26',3,2,1,0.5,'������ ���� �ڵ�');
INSERT INTO mp_work_data VALUES (443,1,'2010-11-02',3,2,1,1.5,'11�� 4�� ����DM');
INSERT INTO mp_work_data VALUES (444,1,'2010-11-15',3,2,1,1.5,'11�� 16�� ����DM');
INSERT INTO mp_work_data VALUES (445,1,'2010-11-18',4,2,1,1.5,'���Ͽ��߱�_���Ż���');
INSERT INTO mp_work_data VALUES (446,1,'2010-11-18',4,2,1,1.5,'���Ͽ��߱�_Ư����������');
INSERT INTO mp_work_data VALUES (447,1,'2010-11-18',4,2,1,2.5,'���Ͽ��߱�_ģ����õ�̺�Ʈ');
INSERT INTO mp_work_data VALUES (448,1,'2010-11-18',4,2,1,2.5,'���Ͽ��߱�_������');
INSERT INTO mp_work_data VALUES (449,1,'2010-11-19',4,1,1,0.5,'�ڿ��� �߱��� DM ������û');
INSERT INTO mp_work_data VALUES (450,1,'2010-11-24',4,1,1,1.0,'�߱��� ȸ�� ���_ģ�� ��õ �̺�Ʈ_����');
INSERT INTO mp_work_data VALUES (451,1,'2010-11-26',4,2,1,1.0,'�������� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (452,1,'2010-11-26',4,2,1,1.0,'������� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (453,1,'2010-11-15',4,2,1,1.5,'11�� 16���� ����DM');
INSERT INTO mp_work_data VALUES (454,1,'2010-11-19',4,2,1,1.0,'�����DM');
INSERT INTO mp_work_data VALUES (455,1,'2010-11-23',4,2,1,1.0,'�߱��δ��DM');
INSERT INTO mp_work_data VALUES (456,1,'2010-11-01',5,1,1,1.0,'�˾������û');
INSERT INTO mp_work_data VALUES (457,1,'2010-11-01',5,1,1,1.0,'�����˾� ��ü��û');
INSERT INTO mp_work_data VALUES (458,1,'2010-11-02',5,2,1,0.5,'�˾�����');
INSERT INTO mp_work_data VALUES (459,1,'2010-11-03',5,1,1,1.0,'�̺�Ʈ�ȳ� �ڵ���û');
INSERT INTO mp_work_data VALUES (460,1,'2010-11-04',5,2,1,1.0,'����,�߹� ����Ʈ �ؽ�Ʈ����');
INSERT INTO mp_work_data VALUES (461,1,'2010-11-09',5,1,1,0.5,'�̺�Ʈī�޷α������� �ڵ���û');
INSERT INTO mp_work_data VALUES (462,1,'2010-11-11',5,1,1,1.0,'�����˾� �ڵ� �� 1�� �ڵ���û');
INSERT INTO mp_work_data VALUES (463,1,'2010-11-12',5,1,1,0.5,'���� �˾���ü��û');
INSERT INTO mp_work_data VALUES (464,1,'2010-11-17',5,1,1,3.0,'������ Ǫ�� ������û');
INSERT INTO mp_work_data VALUES (465,1,'2010-11-18',5,2,1,1.0,'��õ���׸鼼����������');
INSERT INTO mp_work_data VALUES (466,1,'2010-11-22',5,2,1,0.5,'�Ű���ȸ�� �������� �̹��� ��ü');
INSERT INTO mp_work_data VALUES (467,1,'2010-11-23',5,2,1,0.5,'�ؽ�Ʈ ����');
INSERT INTO mp_work_data VALUES (468,1,'2010-11-25',5,2,1,1.0,'�ڵ� ����');
INSERT INTO mp_work_data VALUES (469,1,'2010-11-25',5,1,1,1.0,'�ڵ� ������û');
INSERT INTO mp_work_data VALUES (470,1,'2010-11-30',5,1,1,1.0,'vipȸ������ ������ ������û');
INSERT INTO mp_work_data VALUES (471,1,'2010-11-12',5,2,1,1.5,'[�߹�] 11��15��');
INSERT INTO mp_work_data VALUES (472,1,'2010-11-15',5,2,1,1.5,'[����] 11�� 17��');
INSERT INTO mp_work_data VALUES (473,1,'2010-11-01',5,2,1,0.5,'[�Ϲ�] 11�� ������ŷ ����');
INSERT INTO mp_work_data VALUES (474,1,'2010-11-01',5,1,1,0.5,'[�Ϲ�] �Ϲ�����Ʈ �ؽ�Ʈ ����');
INSERT INTO mp_work_data VALUES (475,1,'2010-11-02',5,2,1,0.5,'[�Ϲ�] �ڿ����� �ѱ���� �̹��� ��ü');
INSERT INTO mp_work_data VALUES (476,1,'2010-11-03',5,2,1,0.5,'[�Ϲ�] ������� ���������� �ϴܹ�� �ڵ�');
INSERT INTO mp_work_data VALUES (477,1,'2010-11-03',5,1,1,0.5,'[�Ϲ�] �Ϲ�����Ʈ �ؽ�Ʈ ����');
INSERT INTO mp_work_data VALUES (478,1,'2010-11-05',5,1,1,1.0,'[�Ϲ�] �̺�Ʈ ī�޷α� �߰�');
INSERT INTO mp_work_data VALUES (479,1,'2010-11-05',5,1,1,0.5,'[�Ϲ�] �Ϲ�����Ʈ �ؽ�Ʈ ����');
INSERT INTO mp_work_data VALUES (480,1,'2010-11-11',5,1,1,1.0,'[�Ϲ�] ���ι�� �ڵ�');
INSERT INTO mp_work_data VALUES (481,1,'2010-11-11',5,1,1,0.5,'[�Ϲ�] �̺�Ʈ ī�޷α� ��ũ����');
INSERT INTO mp_work_data VALUES (482,1,'2010-11-12',5,1,1,0.5,'[�Ϲ�] �������� ��ũ����');
INSERT INTO mp_work_data VALUES (483,1,'2010-11-12',5,1,1,1.5,'[�Ϲ�] �����ð� �� �����߰�');
INSERT INTO mp_work_data VALUES (484,1,'2010-11-16',5,2,1,1.0,'[�Ϲ�] �λ��� ī�޷α��߰�');
INSERT INTO mp_work_data VALUES (485,1,'2010-11-16',5,2,1,1.0,'[�Ϲ�] �����̺�Ʈ������? ��ũ�̹����߰�');
INSERT INTO mp_work_data VALUES (486,1,'2010-11-18',5,1,1,0.5,'[�Ϲ�] �Ϲ�����Ʈ �ؽ�Ʈ ����');
INSERT INTO mp_work_data VALUES (487,1,'2010-11-19',5,1,1,1.0,'[�Ϲ�] �ڿ����� �̹��� ��ü �� �ؽ�Ʈ ����');
INSERT INTO mp_work_data VALUES (488,1,'2010-11-22',5,1,1,1.5,'[�Ϲ�] �ȹ� 11��ȣ');
INSERT INTO mp_work_data VALUES (489,1,'2010-11-22',5,2,1,1.0,'[�Ϲ�] �Ű���ȸ�� �������� �̹��� ��ü');
INSERT INTO mp_work_data VALUES (490,1,'2010-11-26',5,2,1,1.0,'[�Ϲ�] 12�� ������ŷ ����');
INSERT INTO mp_work_data VALUES (491,1,'2010-11-26',5,1,1,0.5,'[�Ϲ�] ������ �൵ �̹�����ü');
INSERT INTO mp_work_data VALUES (492,1,'2010-11-29',5,1,1,0.5,'[�Ϲ�] �����̹��� ��ü');
INSERT INTO mp_work_data VALUES (493,1,'2010-11-30',5,1,1,0.5,'[�Ϲ�] �Ϲ�����Ʈ �ؽ�Ʈ ����');
INSERT INTO mp_work_data VALUES (494,1,'2010-11-11',5,2,1,2.0,'[�Ϲ�] 11��12�� �����, ���ڸ���');
INSERT INTO mp_work_data VALUES (495,1,'2010-11-23',5,2,1,2.0,'[�Ϲ�] 11��25�� �����, ���ڸ���');
INSERT INTO mp_work_data VALUES (496,1,'2010-11-02',6,2,1,0.5,'����1�ֳ� �̺�Ʈ���ῡ ���� ����');
INSERT INTO mp_work_data VALUES (497,1,'2010-11-11',6,1,1,2.0,'�ܷ����Ӽ��˻� �ȳ��� ������');
INSERT INTO mp_work_data VALUES (498,1,'2010-11-15',6,1,1,1.0,'�Ե����۸��ο������');
INSERT INTO mp_work_data VALUES (499,1,'2010-11-15',6,1,1,1.0,'�Ե����۳� �Ե�JTB �ΰ��߰��ڵ���û');
INSERT INTO mp_work_data VALUES (500,1,'2010-11-16',6,1,1,1.0,'����1�ֳ�Ү�̺�Ʈ3 �������̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (501,1,'2010-11-25',6,1,1,1.0,'�Ե����ĳ� ���ۻ���Ʈ ����');
INSERT INTO mp_work_data VALUES (502,1,'2010-11-26',6,2,1,1.0,'12���������̺�Ʈ�ڵ�');
INSERT INTO mp_work_data VALUES (503,1,'2010-11-03',6,2,1,1.5,'11�� 1���� �Ϲ�,�ù�� DM');
INSERT INTO mp_work_data VALUES (504,1,'2010-11-04',6,2,1,1.0,'11�� 1���� �ָ�����DM');
INSERT INTO mp_work_data VALUES (505,1,'2010-11-10',6,2,1,1.5,'11�� 2���� �Ϲ�,�ù�� DM');
INSERT INTO mp_work_data VALUES (506,1,'2010-11-11',6,2,1,1.0,'11�� 2���� �ָ�����DM');
INSERT INTO mp_work_data VALUES (507,1,'2010-11-11',6,2,1,1.0,'��Ȱ��ǰ �ܵ�DM');
INSERT INTO mp_work_data VALUES (508,1,'2010-11-17',6,2,1,1.5,'11�� 3���� �Ϲ�,�ù�� DM');
INSERT INTO mp_work_data VALUES (509,1,'2010-11-18',6,2,1,1.0,'11�� 3���� �ָ�����DM');
INSERT INTO mp_work_data VALUES (510,1,'2010-11-24',6,2,1,1.5,'11�� 4���� �Ϲ�,�ù�� DM');
INSERT INTO mp_work_data VALUES (511,1,'2010-11-25',6,2,1,1.0,'11�� 4���� �ָ�����DM');
INSERT INTO mp_work_data VALUES (512,1,'2010-11-26',10,1,1,1.0,'��ǰ�̹��� ���ε� ��û');
INSERT INTO mp_work_data VALUES (513,1,'2010-11-29',10,1,1,3.0,'�ܿｺŲ ���� ���� �ȳ�');
INSERT INTO mp_work_data VALUES (514,1,'2010-11-02',10,2,1,1.5,'�÷��� 39ȣ DM');
INSERT INTO mp_work_data VALUES (515,1,'2010-11-16',10,2,1,1.5,'�÷��� 40ȣ DM');
INSERT INTO mp_work_data VALUES (516,1,'2010-11-22',11,1,1,1.0,'IR �����ڷ� ���� ��ü');
INSERT INTO mp_work_data VALUES (517,1,'2010-11-02',12,2,1,0.5,'��ũ ����');
INSERT INTO mp_work_data VALUES (518,1,'2010-11-05',12,1,1,1.0,'����û �� �˾� ��û');
INSERT INTO mp_work_data VALUES (519,1,'2010-11-19',12,2,1,0.5,'������ ����');
INSERT INTO mp_work_data VALUES (520,1,'2010-11-26',12,1,1,2.0,'������ ����');
INSERT INTO mp_work_data VALUES (521,1,'2010-11-09',7,1,1,0.5,'���� ��ī�� ��� ��ġ ����');
INSERT INTO mp_work_data VALUES (522,1,'2010-11-10',7,1,1,1.0,'����Ʈ Ʋ���� ����');
INSERT INTO mp_work_data VALUES (523,1,'2010-11-10',7,1,1,0.5,'�ٺ��� ���� ���� ��ü');
INSERT INTO mp_work_data VALUES (524,1,'2010-11-11',7,1,1,0.5,'�ؿ����� ����_������ ����');
INSERT INTO mp_work_data VALUES (525,1,'2010-11-18',7,1,1,1.5,'�Ź�����_�˾��߰��� ��ũ����');
INSERT INTO mp_work_data VALUES (526,1,'2010-11-22',7,1,1,0.5,'������ �� ��ũ ����');
INSERT INTO mp_work_data VALUES (527,1,'2010-11-25',7,1,1,1.0,'�ű�����_11�� 25�� ����');
INSERT INTO mp_work_data VALUES (528,1,'2010-11-25',7,1,1,0.5,'���̾��˾� ����');
INSERT INTO mp_work_data VALUES (529,1,'2010-11-26',7,1,1,0.5,'������ ����');
INSERT INTO mp_work_data VALUES (530,1,'2010-11-02',8,2,1,1.0,'������ ��÷�ڹ�ǥ �ڵ�');
INSERT INTO mp_work_data VALUES (531,1,'2010-11-15',8,1,1,2.0,'GNB�޴� ������û');
INSERT INTO mp_work_data VALUES (532,1,'2010-11-19',8,2,1,1.0,'������ ������� ����');
INSERT INTO mp_work_data VALUES (533,1,'2010-11-30',8,1,1,4.0,'���� ǲ�Ϳ��� ä��ȳ� �߰� ��û');
INSERT INTO mp_work_data VALUES (534,1,'2010-11-30',8,1,1,1.5,'������ DM');
INSERT INTO mp_work_data VALUES (535,1,'2010-11-03',8,1,1,1.5,'������ DM');
INSERT INTO mp_work_data VALUES (536,1,'2010-11-04',8,1,1,1.5,'������ DM');
INSERT INTO mp_work_data VALUES (537,1,'2010-11-01',13,1,1,0.5,'���񴺿� ���� ������ ����');
INSERT INTO mp_work_data VALUES (538,1,'2010-11-11',13,1,1,1.0,'���񴺿� �÷ξ� ���̵� 10�� ����');
INSERT INTO mp_work_data VALUES (539,1,'2011-01-07',7,1,1,1.5,'�� ������� ������ �ڵ�');
INSERT INTO mp_work_data VALUES (540,1,'2011-01-11',7,1,2,1.0,'��������ũ �����߰�_����');
INSERT INTO mp_work_data VALUES (541,1,'2011-01-13',7,1,1,1.0,'��������ũ_���ܸ�ũ ����');
INSERT INTO mp_work_data VALUES (542,1,'2011-01-03',5,1,1,1.0,'[�Ϲ�] ���������� �ؽ�Ʈ����');
INSERT INTO mp_work_data VALUES (543,1,'2011-01-04',5,1,1,1.5,'[�Ϲ�] GNB�޴� ��ܹ�� ��ü');
INSERT INTO mp_work_data VALUES (544,1,'2011-01-06',5,1,1,0.5,'[�Ϲ�] ���޹�� �̹�����ü');
INSERT INTO mp_work_data VALUES (545,1,'2011-01-13',5,1,1,1.5,'���� ���� �˾� �����û');
INSERT INTO mp_work_data VALUES (546,1,'2011-01-03',1,1,1,0.5,'������ �̺�Ʈ �˾� ���� �۾���û');
INSERT INTO mp_work_data VALUES (547,1,'2011-01-03',1,1,1,1.0,'������ �̺�Ʈ �˾� �߰�/���� �ڵ� �۾���û');
INSERT INTO mp_work_data VALUES (548,1,'2011-01-03',1,1,1,1.0,'������ ���ϸ��� ���� �ߴ����� ���� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (549,1,'2011-01-03',1,1,1,0.5,'�뱸���ö��� �����˾� �������� ��û');
INSERT INTO mp_work_data VALUES (550,1,'2011-01-03',1,1,1,1.0,'�Ե���ȭ�� ���ο� �� ������ �ڵ� �۾���û');
INSERT INTO mp_work_data VALUES (551,1,'2011-01-06',1,1,1,0.5,'�뱸���� �˾� �����û');
INSERT INTO mp_work_data VALUES (552,1,'2011-01-06',1,1,1,1.5,'1��1���� ����dm');
INSERT INTO mp_work_data VALUES (553,1,'2011-01-06',1,1,1,1.0,'���� TV������ ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (554,1,'2011-01-06',1,1,1,2.0,'���Ե�N ��۳��� �ٹٲ� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (555,1,'2011-01-07',1,1,1,0.5,'������ �̺�Ʈ ������ �ڵ� ������û');
INSERT INTO mp_work_data VALUES (556,1,'2011-01-10',1,1,1,0.5,'������ �̺�Ʈ �ڵ� ������û');
INSERT INTO mp_work_data VALUES (557,1,'2011-01-11',1,1,1,0.5,'�����˾�(����Ʈ����ȭ���ȳ�)');
INSERT INTO mp_work_data VALUES (558,1,'2011-01-12',1,1,1,1.0,'��ǰ��&ī�� ������� ��� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (559,1,'2011-01-12',1,1,1,1.0,'õ���� Ȩ������ ������� ������ �ڵ���û');
INSERT INTO mp_work_data VALUES (560,1,'2011-01-13',1,1,1,2.0,'����,�߹�,�Ϲ� ������ �˾� �ڵ�');
INSERT INTO mp_work_data VALUES (561,1,'2011-01-14',1,1,1,0.5,'�д��� ��ǰ�� ����ũ �� ����');
INSERT INTO mp_work_data VALUES (562,1,'2011-01-14',1,1,1,0.5,'���Ե�N �˾� ��۳��� �ٹٲ� �ڵ� ������û');
INSERT INTO mp_work_data VALUES (563,1,'2011-01-12',12,1,1,1.0,'�λ縻 ������ ����');
INSERT INTO mp_work_data VALUES (564,1,'2011-01-03',2,1,1,0.5,'1�� 3�� ���� dm ������� ������û');
INSERT INTO mp_work_data VALUES (565,1,'2011-01-04',2,1,1,0.5,'������ �ε��������� ������û');
INSERT INTO mp_work_data VALUES (566,1,'2011-01-04',2,1,1,1.0,'�׺� �ڵ���û');
INSERT INTO mp_work_data VALUES (567,1,'2011-01-04',2,1,1,1.0,'���λ�ù����DM');
INSERT INTO mp_work_data VALUES (568,1,'2011-01-04',2,1,1,2.0,'��Ʈ�� ��Ƽ ��ǰ�� �̺�Ʈ �۾���û');
INSERT INTO mp_work_data VALUES (569,1,'2011-01-06',2,1,1,0.5,'1��10���� DM ������û');
INSERT INTO mp_work_data VALUES (570,1,'2011-01-06',2,1,1,1.0,'1�� 6�� �÷�Ƽ�� ���� ��߼� DM �ڵ���û');
INSERT INTO mp_work_data VALUES (571,1,'2011-01-07',2,1,1,1.5,'1��11���� �ܱ��� Ÿ�� DM �ڵ���û');
INSERT INTO mp_work_data VALUES (572,1,'2011-01-07',2,1,1,0.5,'1�� 6�� ù���� DM �ڵ� ������û');
INSERT INTO mp_work_data VALUES (573,1,'2011-01-07',2,1,1,1.5,'�ֹ����ۼ� �ܰ��� ���� ��ȸ �� ���� �˾�');
INSERT INTO mp_work_data VALUES (574,1,'2011-01-07',2,1,1,1.5,'���ٸ����� ���ſ� �̺�Ʈ �ڵ���û');
INSERT INTO mp_work_data VALUES (575,1,'2011-01-10',2,1,1,1.0,'�籸�� �� �������� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (576,1,'2011-01-10',2,1,1,0.5,'1�� 10���� dm ������û');
INSERT INTO mp_work_data VALUES (577,1,'2011-01-10',2,1,1,6.0,'�ڵ��߼� ���� �ڵ� ���� ��û');
INSERT INTO mp_work_data VALUES (578,1,'2011-01-11',2,1,1,0.5,'1�� 12�� ���� DM �ڵ� ������û');
INSERT INTO mp_work_data VALUES (579,1,'2011-01-12',2,1,1,1.0,'�̺�Ʈ�׺񿵿� �߰�');
INSERT INTO mp_work_data VALUES (580,1,'2011-01-12',2,1,1,0.5,'1�� 12�� �籸�� ����');
INSERT INTO mp_work_data VALUES (581,1,'2011-01-12',2,1,1,1.5,'1�� 12�� �籸�� DM �ڵ���û');
INSERT INTO mp_work_data VALUES (582,1,'2011-01-13',2,1,1,0.5,'����������� ������ �׺� ������û');
INSERT INTO mp_work_data VALUES (583,1,'2011-01-13',2,1,1,0.5,'17�� ����dm ǰ����ǰ ��ü');
INSERT INTO mp_work_data VALUES (584,1,'2011-01-13',2,1,1,1.0,'���������� ���� ������ ���� ǥ��');
INSERT INTO mp_work_data VALUES (585,1,'2011-01-14',2,1,1,1.0,'���ٸ����� ĳ���� ��Ʈ ���� �̺�Ʈ');
INSERT INTO mp_work_data VALUES (586,1,'2011-01-14',2,1,1,0.5,'����ī�� �̺�Ʈ �������� ����');
INSERT INTO mp_work_data VALUES (587,1,'2011-01-14',2,1,1,0.5,'�̺�Ʈ �׺񿵿� ����');
INSERT INTO mp_work_data VALUES (588,1,'2011-01-06',6,1,1,1.0,'1�� 1�� �ָ�DM �ڵ� ��û��');
INSERT INTO mp_work_data VALUES (589,1,'2011-01-06',6,1,1,1.0,'���������������DM');
INSERT INTO mp_work_data VALUES (590,1,'2011-01-11',6,1,1,2.0,'������ ����');
INSERT INTO mp_work_data VALUES (591,1,'2011-01-12',6,1,1,1.5,'����������_��ī�װ����������ī�߰�');
INSERT INTO mp_work_data VALUES (592,1,'2011-01-13',6,1,1,3.0,'���۸��λ��غ���������ܻ���_���̵�ϻ��Կ�û');
INSERT INTO mp_work_data VALUES (593,1,'2011-01-13',6,1,1,1.5,'������10%���� �˶������ϼ����ڵ�');
INSERT INTO mp_work_data VALUES (594,1,'2011-01-14',6,1,1,1.0,'����Ʈ��ܹ�ʹи����� ������û');
INSERT INTO mp_work_data VALUES (595,1,'2011-01-14',6,1,1,1.0,'�����οϷ�_���������μ�����û');
INSERT INTO mp_work_data VALUES (596,1,'2011-01-14',6,1,1,1.5,'�����οϷ�_�˶�������_��ε��������������ڵ���û');
INSERT INTO mp_work_data VALUES (597,1,'2011-01-10',4,1,1,1.0,'ũ��������Ʈ�� ��� ������ �̺�Ʈ ��÷�ڹ�ǥ �ڵ���û');
INSERT INTO mp_work_data VALUES (598,1,'2011-01-10',4,1,1,1.5,'1�� 11�� �߼� �ڿ��� ����DM �ڵ� ��û');
INSERT INTO mp_work_data VALUES (599,1,'2011-01-12',4,1,1,0.5,'DM ���� ��û�帳�ϴ�.');
INSERT INTO mp_work_data VALUES (600,1,'2011-01-03',3,1,1,1.5,'1�� ���� DM_1�� 5�� �߼�');
INSERT INTO mp_work_data VALUES (601,1,'2011-01-04',3,1,1,0.5,'1�� 5�� ���� dm ������û');
INSERT INTO mp_work_data VALUES (602,1,'2011-01-06',3,1,1,1.5,'����� ���ſ� �ڵ� ��û(�������ڷ� ÷��)');
INSERT INTO mp_work_data VALUES (603,1,'2011-01-07',3,1,1,2.0,'����_���� ���� �ݿ�');
INSERT INTO mp_work_data VALUES (604,1,'2011-01-07',3,1,1,1.5,'����_���̾� �˾� ������ ����');
INSERT INTO mp_work_data VALUES (605,1,'2011-01-04',10,1,1,3.0,'�����庸����(696)');
INSERT INTO mp_work_data VALUES (606,1,'2011-01-04',10,1,1,3.0,'�ܿｺŲ(2��) ���� ��û');
INSERT INTO mp_work_data VALUES (622,2,'2010-12-01',7,3,1,5.0,'���� ��� �۾�(1����)');
INSERT INTO mp_work_data VALUES (621,2,'2010-12-24',7,4,1,3.0,'���� �÷��� ��ư ��ũ �� �̹��� ��ü');
INSERT INTO mp_work_data VALUES (620,2,'2010-12-17',7,4,1,4.0,'������ ��ũ �޴� �߰� �۾�');
INSERT INTO mp_work_data VALUES (619,2,'2010-12-10',7,4,1,8.0,'�ű� ���� ���� (�� 3�� ����)');
INSERT INTO mp_work_data VALUES (618,2,'2010-12-10',7,4,1,3.0,'CI ��ü��');
INSERT INTO mp_work_data VALUES (623,2,'2010-12-08',7,3,1,5.0,'���� ��� �۾�(2����)');
INSERT INTO mp_work_data VALUES (624,2,'2010-12-15',7,3,1,5.0,'���� ��� �۾�(3����)');
INSERT INTO mp_work_data VALUES (625,2,'2010-12-29',7,3,1,5.0,'���� ��� �۾�(4����)');
INSERT INTO mp_work_data VALUES (626,2,'2011-01-13',7,3,1,2.0,'��Ʈ ��ȹ�� ��� �÷��� ����');
INSERT INTO mp_work_data VALUES (627,2,'2010-12-02',5,4,1,5.0,'�����߹� ���ͳ��� ��ũURL����');
INSERT INTO mp_work_data VALUES (628,2,'2010-12-06',5,4,1,6.0,'�߹�_�̺�Ʈ�޴��߰�');
INSERT INTO mp_work_data VALUES (629,2,'2010-12-22',5,4,1,3.0,'���߹� �÷��� ��� �� �׼� ����');
INSERT INTO mp_work_data VALUES (630,2,'2010-12-23',5,4,1,4.0,'���߹� �ΰ� ���� ����');
INSERT INTO mp_work_data VALUES (631,2,'2010-12-23',5,4,1,3.0,'���� ���� ���� ��ȭ��ȣ �ּ� ����');
INSERT INTO mp_work_data VALUES (632,2,'2010-12-29',5,4,1,6.0,'�߹� ������ �޴� ����');
INSERT INTO mp_work_data VALUES (633,2,'2011-01-04',5,4,1,5.0,'�߹� ����Ʈ ��Ÿ ����');
INSERT INTO mp_work_data VALUES (634,2,'2010-12-06',5,3,1,5.0,'CM�������� �÷����۾�');
INSERT INTO mp_work_data VALUES (635,2,'2010-12-06',5,3,1,15.0,'�ܿ���� ���Ʊ�ü');
INSERT INTO mp_work_data VALUES (636,2,'2010-12-14',5,3,1,5.0,'���߹� ���� ���Ʊ�ü');
INSERT INTO mp_work_data VALUES (637,2,'2010-12-22',5,3,1,4.0,'���߹� �÷��� ��� �� �׼� ����');
INSERT INTO mp_work_data VALUES (638,2,'2010-12-01',1,4,1,3.0,'���� ���� �̺�Ʈ���, ������ ���� �۾�');
INSERT INTO mp_work_data VALUES (639,2,'2010-12-02',1,4,1,7.0,'Happy Christmas & Adieu 2010 Party �̺�Ʈ �÷��� �۾�');
INSERT INTO mp_work_data VALUES (640,2,'2010-12-06',1,4,1,5.0,'10�� ���� ������� ��Ʈ�� �÷��� �۾�');
INSERT INTO mp_work_data VALUES (641,2,'2010-12-09',1,4,1,3.0,'10�� ���� ������� ��Ʈ�� ����� ����');
INSERT INTO mp_work_data VALUES (642,2,'2010-12-10',1,4,1,2.0,'10�� ���� ������� ��Ʈ�� ����� ����');
INSERT INTO mp_work_data VALUES (643,2,'2010-12-15',1,4,1,5.0,'��ȭȦ ���� ���� �ȳ� ����� ����');
INSERT INTO mp_work_data VALUES (644,2,'2010-12-29',1,4,1,3.0,'õ���� �̹��� �� �ؽ�Ʈ ����');
INSERT INTO mp_work_data VALUES (645,2,'2010-12-30',1,4,1,6.0,'��ȭ�� ���� �� ����Ʈ �ϴ� ���� footer ����');
INSERT INTO mp_work_data VALUES (646,2,'2011-01-03',1,4,1,5.0,'���ο� �� ������ �÷��̾� ����');
INSERT INTO mp_work_data VALUES (647,2,'2011-01-05',1,4,1,3.0,'���� ���� �������� ����� ����');
INSERT INTO mp_work_data VALUES (648,2,'2011-01-05',1,4,1,5.0,'�Ե� ��ǰ�� �Ұ� ������ ������ �÷��� ����');
INSERT INTO mp_work_data VALUES (649,2,'2011-01-06',1,4,1,7.0,'���� ���� �÷��� ����');
INSERT INTO mp_work_data VALUES (650,2,'2011-01-06',1,4,1,3.0,'õ���� ���� �÷��� �̹��� ��ü');
INSERT INTO mp_work_data VALUES (651,2,'2011-01-07',1,4,1,1.0,'���� ���� �ϴ� �κ� �̹��� ����');
INSERT INTO mp_work_data VALUES (652,2,'2011-01-07',1,4,1,1.0,'���� ���� �ϴ� �κ� �̹��� ����');
INSERT INTO mp_work_data VALUES (653,2,'2011-01-07',1,4,1,2.0,'���� �̺�Ʈ Ÿ�� �κ� ����');
INSERT INTO mp_work_data VALUES (654,2,'2011-01-10',1,4,1,3.0,'���ö��� ������ ���ϸ��� ����');
INSERT INTO mp_work_data VALUES (655,2,'2011-01-10',1,4,1,2.0,'���� ���� �׸� �̺�Ʈ ��� ����');
INSERT INTO mp_work_data VALUES (656,2,'2011-01-11',1,4,1,2.0,'���� ���� �׸� �̺�Ʈ ��� ����');
INSERT INTO mp_work_data VALUES (657,2,'2011-01-11',1,4,1,2.0,'õ���� Ȩ������ ���� ������� ��� �߰��۾�');
INSERT INTO mp_work_data VALUES (658,2,'2011-01-11',1,4,1,1.0,'���� ���� �̹��� ����');
INSERT INTO mp_work_data VALUES (659,2,'2011-01-12',1,4,1,1.0,'���� ���� �÷��� ������ �߰� �۾�');
INSERT INTO mp_work_data VALUES (660,2,'2011-01-13',1,4,1,1.0,'���� ���� �̹��� ����');
INSERT INTO mp_work_data VALUES (661,2,'2011-01-17',1,4,1,1.0,'���� ���� �̹��� ����');
INSERT INTO mp_work_data VALUES (662,2,'2011-01-18',1,4,1,1.0,'���� ���� �̹��� ����');
INSERT INTO mp_work_data VALUES (663,2,'2011-01-18',1,4,1,3.0,'��ȭ�� gnb �޴� ����');
INSERT INTO mp_work_data VALUES (664,2,'2010-12-03',1,3,1,3.0,'õ���� Ȩ������ ���� �÷��� ���� �۾�');
INSERT INTO mp_work_data VALUES (665,2,'2010-12-06',1,3,1,15.0,'10�� ���� ������� ��Ʈ�� �÷��� �۾�');
INSERT INTO mp_work_data VALUES (666,2,'2010-12-14',12,4,1,3.0,'gnb �޴� ����');
INSERT INTO mp_work_data VALUES (667,2,'2010-12-22',12,4,1,3.0,'���� ������ lnb �޴� ����');
INSERT INTO mp_work_data VALUES (668,2,'2010-12-13',11,3,1,2.0,'[IR]  �����Ȳ ����');
INSERT INTO mp_work_data VALUES (669,2,'2010-12-06',2,4,1,4.0,'���� �ܿ����� �ݿ�');
INSERT INTO mp_work_data VALUES (670,2,'2010-12-09',2,4,1,5.0,'����ȿ������̵� ����');
INSERT INTO mp_work_data VALUES (671,2,'2010-12-23',2,4,1,2.0,'���� �ܿ����� ����');
INSERT INTO mp_work_data VALUES (672,2,'2010-12-31',2,4,1,3.0,'��ƿ�� �̹��� ����');
INSERT INTO mp_work_data VALUES (673,2,'2011-01-12',2,4,1,4.0,'����� ���� ���̵� ����');
INSERT INTO mp_work_data VALUES (674,2,'2011-01-14',2,4,1,5.0,'��ƿ�� ��� ����');
INSERT INTO mp_work_data VALUES (675,2,'2011-01-17',2,4,1,15.0,'��ƿ�� �ִ� ���� ���� �۾�');
INSERT INTO mp_work_data VALUES (676,2,'2010-12-02',6,4,1,4.0,'����Ʈ���ηѸ�������ص����κ���');
INSERT INTO mp_work_data VALUES (677,2,'2010-12-07',6,4,1,7.0,'�Ｎ�����̺�Ʈ');
INSERT INTO mp_work_data VALUES (678,2,'2010-12-08',6,4,1,3.0,'����������_����Ȯ��');
INSERT INTO mp_work_data VALUES (679,2,'2010-12-14',6,4,1,4.0,'�Ｑ ���� �̺�Ʈ ���� ����');
INSERT INTO mp_work_data VALUES (680,2,'2010-12-23',6,4,1,5.0,'���� ��� ���� ������ ����');
INSERT INTO mp_work_data VALUES (681,2,'2010-12-24',6,4,1,20.0,'2011�� ���� ���� ����Ʈ ���� (1�� ���� ����)');
INSERT INTO mp_work_data VALUES (682,2,'2011-01-10',6,4,1,3.0,'���ظ� ��ī�װ� ��ī�װ� �߰� �۾�');
INSERT INTO mp_work_data VALUES (683,2,'2011-01-13',6,4,1,2.0,'���ظ� �̹��� ����');
INSERT INTO mp_work_data VALUES (684,2,'2010-12-31',4,4,1,3.0,'������ ��ũ ����');
INSERT INTO mp_work_data VALUES (685,2,'2011-01-10',4,4,1,3.0,'���� �ΰ� ����');
INSERT INTO mp_work_data VALUES (686,2,'2010-12-07',3,4,1,4.0,'����_�ܿ� ���� �ݿ�');
INSERT INTO mp_work_data VALUES (687,2,'2010-12-16',3,4,1,3.0,'�̿밡�̵� & ����ȿ��� ��Ÿ ����');
INSERT INTO mp_work_data VALUES (688,2,'2010-12-21',3,4,1,10.0,'gnb �� �÷��� ��� ������');
INSERT INTO mp_work_data VALUES (689,2,'2010-12-27',3,4,1,2.0,'���� �ܿ� ���� ����');
INSERT INTO mp_work_data VALUES (690,2,'2011-01-04',3,4,1,4.0,'���� �˻� ������ ���� �÷��� ��� ����');
INSERT INTO mp_work_data VALUES (691,2,'2011-01-06',3,4,1,3.0,'���� ���� ���� �ݿ�');
INSERT INTO mp_work_data VALUES (692,2,'2011-01-06',3,3,1,3.0,'���� ���� ���� �ݿ�');
INSERT INTO mp_work_data VALUES (693,2,'2010-12-20',9,4,1,6.0,'�ű� ���� ���� (���� 2��)');
INSERT INTO mp_work_data VALUES (694,2,'2010-12-21',9,4,1,2.0,'���� �̹��� ���� ���� �۾�');
INSERT INTO mp_work_data VALUES (695,2,'2010-12-31',9,4,1,2.0,'�ϴ� footer ���� ����');
INSERT INTO mp_work_data VALUES (696,2,'2010-12-03',10,4,1,3.0,'���ǽ�Ÿ�Ϻ��~ �Ե�Only �̺�Ʈ');
INSERT INTO mp_work_data VALUES (697,2,'2010-12-06',10,4,1,2.0,'�÷��� �̺�Ʈ �߰� �� ����');
INSERT INTO mp_work_data VALUES (698,2,'2010-12-07',10,4,1,3.0,'�÷��� �̺�Ʈ �߰� �� ����');
INSERT INTO mp_work_data VALUES (699,2,'2011-01-03',10,4,1,3.0,'������ ������ �̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (700,2,'2011-01-03',10,4,1,2.0,'43ȣ ���� �� �̺�Ʈ �߰�');
INSERT INTO mp_work_data VALUES (701,2,'2010-12-07',10,3,1,15.0,'�÷��� 42ȣ �߰�');
INSERT INTO mp_work_data VALUES (702,2,'2011-01-03',10,3,1,5.0,'������ ������ �̺�Ʈ ����');
INSERT INTO mp_work_data VALUES (703,2,'2011-01-13',10,3,1,15.0,'44ȣ �÷��� ����');
INSERT INTO mp_work_data VALUES (704,1,'2011-01-20',14,1,1,0.5,'���� ���������� ����');
INSERT INTO mp_work_data VALUES (705,1,'2011-01-12',14,1,1,1.5,'�α��� ���� ������(����, ����Ʈ) �ڵ�');
INSERT INTO mp_work_data VALUES (706,1,'2011-01-12',14,1,1,1.0,'ȸ������������ ����, �ϴ� ǲ�� ȸ�� �ּ� �߰�');
INSERT INTO mp_work_data VALUES (707,1,'2011-01-20',15,1,1,5.0,'�����Ǳ׷� ����� �� ���������� �ڵ� �� �׽�Ʈ');
INSERT INTO mp_work_data VALUES (708,1,'2011-01-20',14,1,1,4.0,'���� SS ��� �߰�');
INSERT INTO mp_work_data VALUES (709,1,'2011-01-20',2,1,1,1.0,'������ �ɴ� �̺�Ʈ ��÷�� ��ǥ');

--
-- Table structure for table `mp_worker_info`
--

CREATE TABLE mp_worker_info (
  wid tinyint(3) unsigned NOT NULL auto_increment,
  gid tinyint(3) unsigned NOT NULL default '0',
  seq tinyint(3) unsigned NOT NULL default '0',
  name varchar(20) NOT NULL default '',
  PRIMARY KEY  (wid),
  KEY gid (gid),
  KEY seq (seq)
) TYPE=MyISAM COMMENT='�۾������� ���̺�';

--
-- Dumping data for table `mp_worker_info`
--

INSERT INTO mp_worker_info VALUES (1,1,1,'Ȳö��');
INSERT INTO mp_worker_info VALUES (2,1,2,'�̽���');
INSERT INTO mp_worker_info VALUES (3,2,2,'������');
INSERT INTO mp_worker_info VALUES (4,2,3,'�ۿ���');
INSERT INTO mp_worker_info VALUES (5,2,1,'����');

