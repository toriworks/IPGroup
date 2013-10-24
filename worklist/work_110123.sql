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
) TYPE=MyISAM COMMENT='그룹정보 테이블';

--
-- Dumping data for table `mp_group_info`
--

INSERT INTO mp_group_info VALUES (1,1,'코딩');
INSERT INTO mp_group_info VALUES (2,2,'플래시');

--
-- Table structure for table `mp_project_info`
--

CREATE TABLE mp_project_info (
  pid tinyint(3) unsigned NOT NULL auto_increment,
  seq tinyint(3) unsigned NOT NULL default '0',
  name varchar(40) NOT NULL default '',
  PRIMARY KEY  (pid),
  KEY seq (seq)
) TYPE=MyISAM COMMENT='프로젝트정보 테이블';

--
-- Dumping data for table `mp_project_info`
--

INSERT INTO mp_project_info VALUES (1,1,'롯데백화점');
INSERT INTO mp_project_info VALUES (2,2,'롯데인터넷면세점');
INSERT INTO mp_project_info VALUES (3,3,'부산롯데인터넷면세점');
INSERT INTO mp_project_info VALUES (4,4,'롯데코엑스인터넷면세점');
INSERT INTO mp_project_info VALUES (5,5,'롯데면세점');
INSERT INTO mp_project_info VALUES (6,6,'롯데인터넷슈퍼');
INSERT INTO mp_project_info VALUES (7,7,'롯데마트');
INSERT INTO mp_project_info VALUES (8,8,'롯데아울렛');
INSERT INTO mp_project_info VALUES (9,9,'토이저러스');
INSERT INTO mp_project_info VALUES (10,10,'플레어');
INSERT INTO mp_project_info VALUES (11,11,'롯데쇼핑 IR');
INSERT INTO mp_project_info VALUES (12,12,'롯데백화점 상품본부');
INSERT INTO mp_project_info VALUES (13,13,'에비뉴엘');
INSERT INTO mp_project_info VALUES (14,14,'광렙');
INSERT INTO mp_project_info VALUES (15,15,'기타');

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
) TYPE=MyISAM COMMENT='유형정보 테이블';

--
-- Dumping data for table `mp_type_info`
--

INSERT INTO mp_type_info VALUES (1,1,1,'운영');
INSERT INTO mp_type_info VALUES (2,1,2,'비경상');
INSERT INTO mp_type_info VALUES (3,2,1,'운영');
INSERT INTO mp_type_info VALUES (4,2,2,'비경상');

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
) TYPE=MyISAM COMMENT='작업정보 테이블';

--
-- Dumping data for table `mp_work_data`
--

INSERT INTO mp_work_data VALUES (1,1,'2010-12-01',1,1,1,0.5,'구리점,안산점 팝업 게재중지');
INSERT INTO mp_work_data VALUES (2,1,'2010-12-02',1,2,1,0.5,'롯데 스키/스노보드 페스티벌');
INSERT INTO mp_work_data VALUES (3,1,'2010-12-02',1,1,1,0.5,'세일 인덱스, 우측배너 코딩 수정요청');
INSERT INTO mp_work_data VALUES (4,1,'2010-12-03',1,1,1,4.0,'Happy Christmas & Adieu 2010 Party 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (5,1,'2010-12-06',1,1,1,1.5,'롯데멤버스 통합 영수증 이벤트 제휴사 아울렛 추가 코딩요청');
INSERT INTO mp_work_data VALUES (6,1,'2010-12-06',1,1,1,1.0,'톨스토이 영화시사회 당첨발표');
INSERT INTO mp_work_data VALUES (7,1,'2010-12-07',1,2,1,1.0,'롯데멤버스 영수증 이벤트 메인/지점메인 팝업 코딩');
INSERT INTO mp_work_data VALUES (8,1,'2010-12-07',1,2,1,0.5,'아듀2010파티 수정');
INSERT INTO mp_work_data VALUES (9,1,'2010-12-07',1,2,1,1.0,'대구영플 주말감사품이벤트');
INSERT INTO mp_work_data VALUES (10,1,'2010-12-07',1,1,1,2.0,'Happy Christmas & Adieu 2010 Party 이벤트 코딩 수정요청-쿠폰출력 추가');
INSERT INTO mp_work_data VALUES (11,1,'2010-12-07',1,1,1,1.5,'10조 돌파 온라인 세레모니 코딩요청(10조 달성전)');
INSERT INTO mp_work_data VALUES (12,1,'2010-12-08',1,1,1,3.0,'나를 닮은 디즈니 캐릭터 포토이벤트');
INSERT INTO mp_work_data VALUES (13,1,'2010-12-08',1,2,1,0.5,'지점팝업 게재중지 및 수정');
INSERT INTO mp_work_data VALUES (14,1,'2010-12-09',1,2,1,0.5,'대구영플 감사품 이벤트 팝업 수정');
INSERT INTO mp_work_data VALUES (15,1,'2010-12-09',1,2,1,0.5,'크리스마스 우측배너 코딩 수정');
INSERT INTO mp_work_data VALUES (16,1,'2010-12-09',1,1,1,2.5,'디즈니 입체 포토존에 체크인 하세요 페이지 코딩');
INSERT INTO mp_work_data VALUES (17,1,'2010-12-09',1,1,1,1.0,'크리스마스 인덱스/우측배너 코딩 요청');
INSERT INTO mp_work_data VALUES (18,1,'2010-12-10',1,1,1,1.5,'크리스마스 선물제안 페이지 코딩요청');
INSERT INTO mp_work_data VALUES (19,1,'2010-12-10',1,1,1,3.0,'크리스마스 e-card 보내기 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (20,1,'2010-12-10',1,1,1,1.0,'백화점 관계사 수정');
INSERT INTO mp_work_data VALUES (21,1,'2010-12-10',1,1,1,0.5,'10조 돌파 온라인 세레모니 인트로 게시 중지요청');
INSERT INTO mp_work_data VALUES (22,1,'2010-12-13',1,2,1,1.0,'눈내리는 크리스마스 선물파티');
INSERT INTO mp_work_data VALUES (23,1,'2010-12-13',1,1,1,2.0,'샤롯데N 방송 저화질/고화질 버튼 추가 코딩요청');
INSERT INTO mp_work_data VALUES (24,1,'2010-12-13',1,1,1,4.0,'롯데문화홀 영등포점 추가');
INSERT INTO mp_work_data VALUES (25,1,'2010-12-14',1,2,1,0.5,'청주영플팝업');
INSERT INTO mp_work_data VALUES (26,1,'2010-12-14',1,1,1,1.5,'Happy Christmas & Adieu 2010 Party 이벤트 코딩 수정요청');
INSERT INTO mp_work_data VALUES (27,1,'2010-12-14',1,2,1,1.0,'대구영플 주말감사품이벤트');
INSERT INTO mp_work_data VALUES (28,1,'2010-12-15',1,1,1,0.5,'백화점 메인 멤버스 영수증 이벤트 팝업 게시 종료요청');
INSERT INTO mp_work_data VALUES (29,1,'2010-12-15',1,1,1,1.0,'온라인 회원 대상 감사품 쿠폰 출력이벤트');
INSERT INTO mp_work_data VALUES (30,1,'2010-12-15',1,1,1,1.0,'NCSI 지점메인 팝업 코딩요청');
INSERT INTO mp_work_data VALUES (31,1,'2010-12-16',1,2,1,0.5,'포항점 과메기 배송 안내 팝업 (취소)');
INSERT INTO mp_work_data VALUES (32,1,'2010-12-16',1,2,1,0.5,'롯데문화홀 대관안내 페이지 수정');
INSERT INTO mp_work_data VALUES (33,1,'2010-12-16',1,1,1,0.5,'영등포점 롯데갤러리 페이지');
INSERT INTO mp_work_data VALUES (34,1,'2010-12-16',1,1,1,1.0,'위드유 마일리지 일시중지 안내 팝업 코딩요청');
INSERT INTO mp_work_data VALUES (35,1,'2010-12-16',1,1,1,3.0,'덕담 릴레이 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (36,1,'2010-12-16',1,1,1,1.0,'감사품+위드유 마일리지 DM 코딩요청');
INSERT INTO mp_work_data VALUES (37,1,'2010-12-17',1,2,1,0.5,'대구영플 팝업');
INSERT INTO mp_work_data VALUES (38,1,'2010-12-17',1,2,1,0.5,'크리스마스 인덱스 코딩 수정');
INSERT INTO mp_work_data VALUES (39,1,'2010-12-21',1,2,1,1.0,'대구영플 주말감사품이벤트');
INSERT INTO mp_work_data VALUES (40,1,'2010-12-22',1,2,1,1.0,'스마트폰 영화제 코딩');
INSERT INTO mp_work_data VALUES (41,1,'2010-12-22',1,2,1,1.0,'역사편지쓰기 공모전 DM 코딩');
INSERT INTO mp_work_data VALUES (42,1,'2010-12-22',1,1,1,1.0,'라스트갓파더 초대권을드립니다');
INSERT INTO mp_work_data VALUES (43,1,'2010-12-22',1,1,1,0.5,'하단푸터 관계사 바로가기 수정');
INSERT INTO mp_work_data VALUES (44,1,'2010-12-23',1,2,1,0.5,'온라인 회원 감사품 팝업 코딩');
INSERT INTO mp_work_data VALUES (45,1,'2010-12-23',1,2,1,1.0,'감사품+위드유 마일리지 DM 코딩');
INSERT INTO mp_work_data VALUES (46,1,'2010-12-23',1,1,1,0.5,'설마중 롯데상품권 코딩요청');
INSERT INTO mp_work_data VALUES (47,1,'2010-12-24',1,2,1,0.5,'백화점 휴점안내 팝업');
INSERT INTO mp_work_data VALUES (48,1,'2010-12-27',1,2,1,1.0,'유명브랜드 세일 코딩');
INSERT INTO mp_work_data VALUES (49,1,'2010-12-27',1,1,1,1.0,'아듀 2010당첨발표');
INSERT INTO mp_work_data VALUES (50,1,'2010-12-27',1,1,1,1.5,'「샤갈전」아트 경품 大축제! 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (51,1,'2010-12-28',1,1,1,0.5,'스마트폰 영화제 페이지 수정');
INSERT INTO mp_work_data VALUES (52,1,'2010-12-28',1,1,1,0.5,'IR 실적자료 파일 교체');
INSERT INTO mp_work_data VALUES (53,1,'2010-12-29',1,1,1,0.5,'천진점 홈페이지 코딩수정 작업 요청');
INSERT INTO mp_work_data VALUES (54,1,'2010-12-29',1,2,1,0.5,'2011 신묘년 운세를 알려드립니다 이벤트 코딩');
INSERT INTO mp_work_data VALUES (55,1,'2010-12-30',1,2,1,2.0,'새해소망 댓글 이벤트');
INSERT INTO mp_work_data VALUES (56,1,'2010-12-30',1,2,1,0.5,'백화점 휴점안내 팝업');
INSERT INTO mp_work_data VALUES (57,1,'2010-12-30',1,2,1,0.5,'설마중 우측배너 코딩 수정');
INSERT INTO mp_work_data VALUES (58,1,'2010-12-30',1,1,1,0.5,'휴점안내팝업 수정');
INSERT INTO mp_work_data VALUES (59,1,'2010-12-30',1,1,1,0.5,'NCSI 지점메인 팝업 게시종료 요청');
INSERT INTO mp_work_data VALUES (60,1,'2010-12-30',1,1,1,2.0,'샤롯데N 방송 팝업 내 저화질/고화질 버튼 추가 코딩요청');
INSERT INTO mp_work_data VALUES (61,1,'2010-12-30',1,1,1,0.5,'설마중 우측배너 코딩 수정요청');
INSERT INTO mp_work_data VALUES (62,1,'2010-12-31',1,2,1,2.0,'위드유 마일리지 적립 중단으로 인한 코딩 수정');
INSERT INTO mp_work_data VALUES (63,1,'2010-12-31',1,2,1,0.5,'설마중 우측배너 코딩 수정');
INSERT INTO mp_work_data VALUES (64,1,'2010-12-02',1,2,1,1.5,'12월 1주 정기DM');
INSERT INTO mp_work_data VALUES (65,1,'2010-12-09',1,2,1,1.5,'12월 2주 정기DM');
INSERT INTO mp_work_data VALUES (66,1,'2010-12-16',1,2,1,1.5,'12월 3주 정기DM');
INSERT INTO mp_work_data VALUES (67,1,'2010-12-23',1,2,1,1.5,'12월 4주 정기DM');
INSERT INTO mp_work_data VALUES (68,1,'2010-12-30',1,2,1,1.5,'12월 5주 정기DM');
INSERT INTO mp_work_data VALUES (69,1,'2010-12-01',2,2,1,0.5,'하나은행 페이지 코딩 수정');
INSERT INTO mp_work_data VALUES (70,1,'2010-12-01',2,1,1,2.0,'포인트관련이벤트 상단네비영역 수정요청');
INSERT INTO mp_work_data VALUES (71,1,'2010-12-02',2,1,1,0.5,'텐텐텐이벤트 당첨자발표 수정요청');
INSERT INTO mp_work_data VALUES (72,1,'2010-12-02',2,1,1,1.0,'MVG 이벤트 코딩 수정요청');
INSERT INTO mp_work_data VALUES (73,1,'2010-12-02',2,1,1,0.5,'본웨딩 이벤트 팝업코딩요청');
INSERT INTO mp_work_data VALUES (74,1,'2010-12-02',2,1,1,0.5,'롯데포인트 네비 수정요청');
INSERT INTO mp_work_data VALUES (75,1,'2010-12-02',2,1,1,0.5,'정기세일 수정요청');
INSERT INTO mp_work_data VALUES (76,1,'2010-12-02',2,1,1,0.5,'신규가입이벤트 페이지 코딩수정요청');
INSERT INTO mp_work_data VALUES (77,1,'2010-12-02',2,2,1,1.0,'하이원 가요대상 초대권증정 이벤트 코딩');
INSERT INTO mp_work_data VALUES (78,1,'2010-12-02',2,2,1,2.0,'메가이벤트 10기 코딩');
INSERT INTO mp_work_data VALUES (79,1,'2010-12-02',2,2,1,2.0,'트릴로지 상품평 이벤트 코딩');
INSERT INTO mp_work_data VALUES (80,1,'2010-12-02',2,2,1,0.5,'고객센터 코딩 수정');
INSERT INTO mp_work_data VALUES (81,1,'2010-12-02',2,2,1,2.0,'캐시백포인트 명칭 수정');
INSERT INTO mp_work_data VALUES (82,1,'2010-12-03',2,1,1,0.5,'전회원님께 13000원 적립 팝업 코딩요청');
INSERT INTO mp_work_data VALUES (83,1,'2010-12-03',2,1,1,1.0,'인천공항 사은권 증정 이벤트');
INSERT INTO mp_work_data VALUES (84,1,'2010-12-03',2,1,1,0.5,'13,000원 증정 이벤트 팝업 코딩 수정요청');
INSERT INTO mp_work_data VALUES (85,1,'2010-12-03',2,1,1,0.5,'포인트이벤트페이지 상단 네비영역 수정');
INSERT INTO mp_work_data VALUES (86,1,'2010-12-03',2,1,1,0.5,'인천공항 사은권 증정 이벤트 수정요청');
INSERT INTO mp_work_data VALUES (87,1,'2010-12-06',2,1,1,0.5,'정기세일 수정요청');
INSERT INTO mp_work_data VALUES (88,1,'2010-12-06',2,1,1,0.5,'12월1일자 DM 수정요청');
INSERT INTO mp_work_data VALUES (89,1,'2010-12-06',2,2,1,1.0,'스페셜 오더 수량 변경 박스 코딩');
INSERT INTO mp_work_data VALUES (90,1,'2010-12-06',2,2,1,2.0,'조르지오 알마니 더블 이벤트');
INSERT INTO mp_work_data VALUES (91,1,'2010-12-06',2,2,1,0.5,'바비브라운 구매왕이벤트 수정');
INSERT INTO mp_work_data VALUES (92,1,'2010-12-07',2,2,1,1.0,'입소문내기 이벤트 수정');
INSERT INTO mp_work_data VALUES (93,1,'2010-12-07',2,1,1,0.5,'급_12월8일 플래티늄 dm 수정요청');
INSERT INTO mp_work_data VALUES (94,1,'2010-12-08',2,1,1,1.5,'12월 10일 첫구매 DM 코딩요청');
INSERT INTO mp_work_data VALUES (95,1,'2010-12-08',2,1,1,1.0,'12월10일 첫구매 코딩 수정요청');
INSERT INTO mp_work_data VALUES (96,1,'2010-12-08',2,1,1,0.5,'하나은행페이지 url수정');
INSERT INTO mp_work_data VALUES (97,1,'2010-12-08',2,2,1,0.5,'메인팝업 수정');
INSERT INTO mp_work_data VALUES (98,1,'2010-12-09',2,2,1,2.0,'현대카드 캐시백 이벤트');
INSERT INTO mp_work_data VALUES (99,1,'2010-12-09',2,2,1,1.0,'고객의 소리를들려주세요 이벤트 내에 옥의티 수정');
INSERT INTO mp_work_data VALUES (100,1,'2010-12-09',2,2,1,1.0,'적립금 사용 안내 팝업 작업');
INSERT INTO mp_work_data VALUES (101,1,'2010-12-09',2,1,1,1.0,'연말 감사 사은품 증정 이벤트 제작요청');
INSERT INTO mp_work_data VALUES (102,1,'2010-12-09',2,1,1,0.5,'현대카드 캐시백 이벤트 수정요청');
INSERT INTO mp_work_data VALUES (103,1,'2010-12-09',2,1,1,1.0,'플래티늄 로그인 팝업 수정');
INSERT INTO mp_work_data VALUES (104,1,'2010-12-09',2,1,1,0.5,'12월10일 첫구매DM수정요청');
INSERT INTO mp_work_data VALUES (105,1,'2010-12-10',2,1,1,0.5,'12월10일 첫구매dm 코딩수정요청');
INSERT INTO mp_work_data VALUES (106,1,'2010-12-10',2,1,1,1.5,'12월13일 정기 코딩 요청');
INSERT INTO mp_work_data VALUES (107,1,'2010-12-10',2,1,1,0.5,'12월13일 정기 dm 코딩수정요청');
INSERT INTO mp_work_data VALUES (108,1,'2010-12-10',2,1,1,0.5,'12월13일 정기 dm 코딩수정요청');
INSERT INTO mp_work_data VALUES (109,1,'2010-12-10',2,1,1,0.5,'롯데포인트 이벤트 상단 링크 수정');
INSERT INTO mp_work_data VALUES (110,1,'2010-12-14',2,2,1,1.0,'구찌 향수 구매왕 이벤트 코딩');
INSERT INTO mp_work_data VALUES (111,1,'2010-12-16',2,2,1,3.0,'안나수이 향수 홍보이벤트');
INSERT INTO mp_work_data VALUES (112,1,'2010-12-16',2,1,1,0.5,'21일자 정기dm 수정요청');
INSERT INTO mp_work_data VALUES (113,1,'2010-12-16',2,1,1,0.5,'21일자 DM 수정요청');
INSERT INTO mp_work_data VALUES (114,1,'2010-12-17',2,2,1,0.5,'우수회원페이지 상품 url수정');
INSERT INTO mp_work_data VALUES (115,1,'2010-12-17',2,2,1,0.5,'쇼핑지원금 이미지 수정');
INSERT INTO mp_work_data VALUES (116,1,'2010-12-21',2,2,1,1.0,'고객의소리 이벤트 페이지 수정');
INSERT INTO mp_work_data VALUES (117,1,'2010-12-21',2,2,1,3.0,'끼리끼리 구매왕 이벤트');
INSERT INTO mp_work_data VALUES (118,1,'2010-12-22',2,2,1,0.5,'포인트 페이백 이벤트 팝업');
INSERT INTO mp_work_data VALUES (119,1,'2010-12-22',2,2,1,3.0,'엘빈 적립금 전환 이벤트');
INSERT INTO mp_work_data VALUES (120,1,'2010-12-22',2,1,1,2.0,'롯데포인트영역추가');
INSERT INTO mp_work_data VALUES (121,1,'2010-12-22',2,1,1,1.5,'고객의소리 옥에티 수정요청');
INSERT INTO mp_work_data VALUES (122,1,'2010-12-22',2,1,1,1.0,'메트로시티 구매왕이벤트 수정요청');
INSERT INTO mp_work_data VALUES (123,1,'2010-12-22',2,1,1,1.0,'롯데멤버스 패밀리사이트 추가등록요청');
INSERT INTO mp_work_data VALUES (124,1,'2010-12-23',2,2,1,1.0,'1월 하나은행 쿠폰 코딩요청');
INSERT INTO mp_work_data VALUES (125,1,'2010-12-23',2,2,1,0.5,'신규가입 첫구매 이벤트');
INSERT INTO mp_work_data VALUES (126,1,'2010-12-23',2,2,1,1.0,'1월 아시아나 쿠폰 이벤트');
INSERT INTO mp_work_data VALUES (127,1,'2010-12-23',2,1,1,0.5,'첫구매이벤트 링크 수정');
INSERT INTO mp_work_data VALUES (128,1,'2010-12-24',2,1,1,0.5,'12월 28일 정기 DM수정요청');
INSERT INTO mp_work_data VALUES (129,1,'2010-12-27',2,2,1,3.0,'좋았다면 다시한번 이벤트 투표 이벤트 코딩');
INSERT INTO mp_work_data VALUES (130,1,'2010-12-27',2,1,1,1.5,'웨딩 구매왕 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (131,1,'2010-12-27',2,1,1,0.5,'12월 28일 정기 DM 종료행사교체요청');
INSERT INTO mp_work_data VALUES (132,1,'2010-12-28',2,1,1,3.0,'신년 덕담, 황금토끼를 잡아라 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (133,1,'2010-12-28',2,1,1,1.0,'교환권 번호 자동응모 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (134,1,'2010-12-28',2,1,1,2.0,'퀴즈이벤트');
INSERT INTO mp_work_data VALUES (135,1,'2010-12-28',2,1,1,3.0,'웨딩페어 오프라인연계 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (136,1,'2010-12-29',2,2,1,0.5,'메인 팝업 수정');
INSERT INTO mp_work_data VALUES (137,1,'2010-12-29',2,2,1,1.0,'회원가입 신규 제작');
INSERT INTO mp_work_data VALUES (138,1,'2010-12-29',2,2,1,0.5,'회원등급 변경안내 페이지 코딩');
INSERT INTO mp_work_data VALUES (139,1,'2010-12-29',2,1,1,2.0,'1월1일 행사 네비 코딩요청');
INSERT INTO mp_work_data VALUES (140,1,'2010-12-30',2,2,1,0.5,'웨딩페어 인덱스 페이지 수정');
INSERT INTO mp_work_data VALUES (141,1,'2010-12-30',2,2,1,0.5,'웨딩 행사 네비 코딩');
INSERT INTO mp_work_data VALUES (142,1,'2010-12-30',2,2,1,2.0,'회원등급 혜택 이벤트');
INSERT INTO mp_work_data VALUES (143,1,'2010-12-30',2,2,1,0.5,'웨딩페어 오프라인연계 이벤트 수정');
INSERT INTO mp_work_data VALUES (144,1,'2010-12-30',2,2,1,1.0,'웨딩 DM 3건 코딩 수정');
INSERT INTO mp_work_data VALUES (145,1,'2010-12-31',2,2,1,1.0,'롯데포인트&적립금 더블적립 이벤트 코딩');
INSERT INTO mp_work_data VALUES (146,1,'2010-12-31',2,2,1,0.5,'웨딩페어 인덱스 페이지_수정2');
INSERT INTO mp_work_data VALUES (147,1,'2010-12-31',2,2,1,0.5,'회원가입 수정_02');
INSERT INTO mp_work_data VALUES (148,1,'2010-12-31',2,2,1,0.5,'회원등급변경 안내페이지 코딩');
INSERT INTO mp_work_data VALUES (149,1,'2010-12-31',2,1,1,0.5,'1월3일 정기 dm 수정요청');
INSERT INTO mp_work_data VALUES (150,1,'2010-12-31',2,1,1,0.5,'1월 4일자 dm 수정요청');
INSERT INTO mp_work_data VALUES (151,1,'2010-12-31',2,1,1,1.0,'하나은행 페이지 내에 게시될 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (152,1,'2010-12-31',2,1,1,0.5,'1월3일 정기 dm 수정요청');
INSERT INTO mp_work_data VALUES (153,1,'2010-12-03',2,2,1,1.5,'12월일자 정기DM');
INSERT INTO mp_work_data VALUES (154,1,'2010-12-13',2,2,1,1.5,'12월15일자 플래티늄DM');
INSERT INTO mp_work_data VALUES (155,1,'2010-12-20',2,2,1,1.5,'12월25일자 엘빈전환DM');
INSERT INTO mp_work_data VALUES (156,1,'2010-12-21',2,2,1,1.5,'12월23일자 플래티늄DM');
INSERT INTO mp_work_data VALUES (157,1,'2010-12-21',2,2,1,1.5,'12월23일자 재구매DM');
INSERT INTO mp_work_data VALUES (158,1,'2010-12-22',2,2,1,1.5,'12월23일자 우수회원DM');
INSERT INTO mp_work_data VALUES (159,1,'2010-12-24',2,2,1,1.5,'12월28일자 정기DM');
INSERT INTO mp_work_data VALUES (160,1,'2010-12-30',2,2,1,1.5,'1월3일자 정기DM');
INSERT INTO mp_work_data VALUES (161,1,'2010-12-31',2,2,1,1.5,'1월4일자 등급별DM');
INSERT INTO mp_work_data VALUES (162,1,'2010-12-02',3,2,1,2.0,'메가이벤트 10기_여자들을 위한 사이판 여행');
INSERT INTO mp_work_data VALUES (163,1,'2010-12-02',3,1,1,2.0,'12월 정기세일');
INSERT INTO mp_work_data VALUES (164,1,'2010-12-07',3,2,1,1.0,'주문결제페이지 코딩');
INSERT INTO mp_work_data VALUES (165,1,'2010-12-08',3,2,1,0.5,'더블할인쿠폰 이벤트 코딩');
INSERT INTO mp_work_data VALUES (166,1,'2010-12-08',3,1,1,2.5,'메인_겨울 컨셉 반영');
INSERT INTO mp_work_data VALUES (167,1,'2010-12-09',3,1,1,2.0,'쿠폰이벤트 네비게이션 코딩 요청 (디자인 자료 첨부)');
INSERT INTO mp_work_data VALUES (168,1,'2010-12-09',3,2,1,0.5,'로그인 팝업 코딩');
INSERT INTO mp_work_data VALUES (169,1,'2010-12-09',3,2,1,0.5,'무제한 더블할인 쿠폰_버튼 추가');
INSERT INTO mp_work_data VALUES (170,1,'2010-12-15',3,1,1,1.5,'12월 정기 DM - 1차_추가발송');
INSERT INTO mp_work_data VALUES (171,1,'2010-12-16',3,2,1,1.0,'메인레이어팝업 코딩');
INSERT INTO mp_work_data VALUES (172,1,'2010-12-17',3,2,1,0.5,'통큰 할인쿠폰');
INSERT INTO mp_work_data VALUES (173,1,'2010-12-17',3,2,1,0.5,'로그인 팝업 수정');
INSERT INTO mp_work_data VALUES (174,1,'2010-12-22',3,1,1,1.0,'롯데멤버스 제휴사 추가_기린식품');
INSERT INTO mp_work_data VALUES (175,1,'2010-12-23',3,1,1,2.5,'1주년 기념_생일 케이크 조각 모으기');
INSERT INTO mp_work_data VALUES (176,1,'2010-12-23',3,1,1,1.5,'엔젤 소멸 안내 팝업');
INSERT INTO mp_work_data VALUES (177,1,'2010-12-24',3,2,1,3.0,'돌잡이 경품 댓글이벤트 코딩');
INSERT INTO mp_work_data VALUES (178,1,'2010-12-24',3,2,1,1.0,'대박 & 첫구매 쿠폰 코딩');
INSERT INTO mp_work_data VALUES (179,1,'2010-12-27',3,2,1,1.0,'근하신년 쿠폰 이벤트');
INSERT INTO mp_work_data VALUES (180,1,'2010-12-29',3,2,1,0.5,'웨딩샵 디자인 변경');
INSERT INTO mp_work_data VALUES (181,1,'2010-12-29',3,2,1,0.5,'더블할인 쿠폰 이벤트 코딩');
INSERT INTO mp_work_data VALUES (182,1,'2010-12-30',3,2,1,0.5,'1주년기념_특별찬스 선착순 빅 쿠폰 이벤트_수정');
INSERT INTO mp_work_data VALUES (183,1,'2010-12-31',3,2,1,0.5,'2011 새해인사 팝업 제작');
INSERT INTO mp_work_data VALUES (184,1,'2010-12-03',3,2,1,1.5,'12월8일자 정기DM');
INSERT INTO mp_work_data VALUES (185,1,'2010-12-20',3,2,1,1.5,'12월22일자 정기DM');
INSERT INTO mp_work_data VALUES (186,1,'2010-12-27',3,2,1,1.5,'12월28일자 엔젤소멸DM');
INSERT INTO mp_work_data VALUES (187,1,'2010-12-01',4,1,1,2.0,'크리스마스 트리 이벤트');
INSERT INTO mp_work_data VALUES (188,1,'2010-12-02',4,2,1,0.5,'뮤지컬 금발이 너무해 이벤트 수정');
INSERT INTO mp_work_data VALUES (189,1,'2010-12-02',4,2,1,1.5,'더블적립 이벤트 코딩');
INSERT INTO mp_work_data VALUES (190,1,'2010-12-02',4,2,1,2.0,'메가이벤트 10기_여자들을 위한 사이판 여행');
INSERT INTO mp_work_data VALUES (191,1,'2010-12-10',4,2,1,1.0,'현대카드 캐시백 이벤트');
INSERT INTO mp_work_data VALUES (192,1,'2010-12-15',4,1,1,1.5,'구슬모아 간식타임 이벤트 외1건 당첨자발표 코딩 요청');
INSERT INTO mp_work_data VALUES (193,1,'2010-12-17',4,1,1,1.0,'3,6,9 크리스피 당첨자발표 코딩을 의뢰합니다.');
INSERT INTO mp_work_data VALUES (194,1,'2010-12-20',4,1,1,1.0,'아이폰4 당첨자 발표건의 문구 추가작업입니다.');
INSERT INTO mp_work_data VALUES (195,1,'2010-12-20',4,1,1,0.5,'당첨자발표 제세공과금 정보 추가건');
INSERT INTO mp_work_data VALUES (196,1,'2010-12-21',4,1,1,1.5,'12월 22일자 DM 코딩 요청드립니다.');
INSERT INTO mp_work_data VALUES (197,1,'2010-12-21',4,1,1,1.5,'구슬소멸기간 연장건');
INSERT INTO mp_work_data VALUES (198,1,'2010-12-21',4,2,1,0.5,'포인트페이백 이벤트건 코딩');
INSERT INTO mp_work_data VALUES (199,1,'2010-12-22',4,2,1,0.5,'다시찾은 이벤트 수정');
INSERT INTO mp_work_data VALUES (200,1,'2010-12-22',4,1,1,1.0,'푸터 기린식품 관계사 추가건');
INSERT INTO mp_work_data VALUES (201,1,'2010-12-29',4,1,1,1.5,'퀴즈쇼쿠폰이벤트 코딩 요청');
INSERT INTO mp_work_data VALUES (202,1,'2010-12-30',4,2,1,1.0,'1월 쿠폰건 코딩');
INSERT INTO mp_work_data VALUES (203,1,'2010-12-30',4,2,1,0.5,'퀴즈이벤트 수정');
INSERT INTO mp_work_data VALUES (204,1,'2010-12-31',4,1,1,1.0,'배너 교체 코딩 요청');
INSERT INTO mp_work_data VALUES (205,1,'2010-12-08',4,2,1,1.5,'12월9일자 DM');
INSERT INTO mp_work_data VALUES (206,1,'2010-12-02',5,2,1,0.5,'메인팝업교체');
INSERT INTO mp_work_data VALUES (207,1,'2010-12-07',5,1,1,1.5,'중문이벤트 페이지 코딩요청');
INSERT INTO mp_work_data VALUES (208,1,'2010-12-10',5,2,1,1.0,'겨울시즌 배경 및 모델 교체');
INSERT INTO mp_work_data VALUES (209,1,'2010-12-10',5,1,1,1.5,'12/13발송 중문DM 코딩요청');
INSERT INTO mp_work_data VALUES (210,1,'2010-12-13',5,1,1,10.0,'겨울시즌 배경 및 모델 교체요청');
INSERT INTO mp_work_data VALUES (211,1,'2010-12-13',5,1,1,1.0,'패밀리콘서트 페이지 코딩요청');
INSERT INTO mp_work_data VALUES (212,1,'2010-12-14',5,2,1,1.0,'비지트코리아 변경');
INSERT INTO mp_work_data VALUES (213,1,'2010-12-14',5,1,1,2.0,'시즌교체 코딩수정 요청');
INSERT INTO mp_work_data VALUES (214,1,'2010-12-15',5,1,1,1.5,'메인 일본관광청 배너추가요청');
INSERT INTO mp_work_data VALUES (215,1,'2010-12-15',5,1,1,1.0,'사이트맵 수정요청');
INSERT INTO mp_work_data VALUES (216,1,'2010-12-21',5,1,1,0.5,'메인_일본관광청배너 교체요청');
INSERT INTO mp_work_data VALUES (217,1,'2010-12-22',5,1,1,0.5,'링크주소 수정요청');
INSERT INTO mp_work_data VALUES (218,1,'2010-12-22',5,1,1,0.5,'제휴사_기린식품 추가요청');
INSERT INTO mp_work_data VALUES (219,1,'2010-12-23',5,1,1,0.5,'링크 수정 요청');
INSERT INTO mp_work_data VALUES (220,1,'2010-12-23',5,1,1,1.0,'메인 하단팝업 교체요청');
INSERT INTO mp_work_data VALUES (221,1,'2010-12-24',5,1,1,1.0,'우측띠배너 변경 요청');
INSERT INTO mp_work_data VALUES (222,1,'2010-12-28',5,1,1,1.5,'중문 텍스트 코딩수정요청');
INSERT INTO mp_work_data VALUES (223,1,'2010-12-28',5,1,1,1.0,'여행사쿠폰 코딩 요청');
INSERT INTO mp_work_data VALUES (224,1,'2010-12-31',5,1,1,3.0,'년변경, 팝업 등 코딩요청');
INSERT INTO mp_work_data VALUES (225,1,'2010-12-09',5,2,1,1.5,'12월12일자 세일DM');
INSERT INTO mp_work_data VALUES (226,1,'2010-12-03',5,1,1,0.5,'[일문] 롯데인터넷 면세점 링크 수정');
INSERT INTO mp_work_data VALUES (227,1,'2010-12-03',5,1,1,1.5,'[일문] 이벤트카달로그');
INSERT INTO mp_work_data VALUES (228,1,'2010-12-07',5,2,1,1.0,'[일문] 메인이미지 및 상단메뉴배너, GNB메뉴배너 교체');
INSERT INTO mp_work_data VALUES (229,1,'2010-12-09',5,2,1,0.5,'[일문] 일문로고 교체');
INSERT INTO mp_work_data VALUES (230,1,'2010-12-13',5,1,1,2.0,'[일문] 메일매거진 회원등록 배너');
INSERT INTO mp_work_data VALUES (231,1,'2010-12-13',5,2,1,0.5,'[일문] 팜므 12월호');
INSERT INTO mp_work_data VALUES (232,1,'2010-12-15',5,1,1,2.0,'[일문] 한류스타갤러리? 패밀리콘서트페이지 수정요청');
INSERT INTO mp_work_data VALUES (233,1,'2010-12-15',5,1,1,1.5,'[일문] 메인페이지_ 좌측메뉴 간격 수정');
INSERT INTO mp_work_data VALUES (234,1,'2010-12-20',5,2,1,1.0,'[일문] 각 지점별 전화번호 및 영업시간 수정');
INSERT INTO mp_work_data VALUES (235,1,'2010-12-22',5,2,1,1.0,'[일문] 지점영업시간 및 대표전화 수정');
INSERT INTO mp_work_data VALUES (236,1,'2010-12-24',5,2,1,1.0,'[일문] 지점 연락처 및 맵 수정');
INSERT INTO mp_work_data VALUES (237,1,'2010-12-24',5,2,1,1.0,'[일문] 스페셜쿠폰 이미지 교체');
INSERT INTO mp_work_data VALUES (238,1,'2010-12-29',5,1,1,2.0,'[일문] 각 지점 매장안내도 교체');
INSERT INTO mp_work_data VALUES (239,1,'2010-12-31',5,1,1,0.5,'[일문] 메일매거진회원쿠폰 이미지 교체');
INSERT INTO mp_work_data VALUES (240,1,'2010-12-03',5,2,1,2.0,'[일문] 12월6일 모바일, 전자메일');
INSERT INTO mp_work_data VALUES (241,1,'2010-12-16',5,2,1,2.0,'[일문] 12월20일 모바일, 전자메일');
INSERT INTO mp_work_data VALUES (242,1,'2010-12-01',6,2,1,1.0,'12월영수증이벤트코딩');
INSERT INTO mp_work_data VALUES (243,1,'2010-12-21',6,2,1,2.0,'369장보기 이벤트');
INSERT INTO mp_work_data VALUES (244,1,'2010-12-01',6,1,1,1.5,'12월1주차 정기 DM 코딩 요청안');
INSERT INTO mp_work_data VALUES (245,1,'2010-12-02',6,1,1,1.0,'12월 1차 주말DM 코딩 요청안');
INSERT INTO mp_work_data VALUES (246,1,'2010-12-03',6,1,1,1.0,'친구추천이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (247,1,'2010-12-03',6,1,1,4.0,'롯데슈퍼 연말분위기로 사이트변경');
INSERT INTO mp_work_data VALUES (248,1,'2010-12-06',6,1,1,3.0,'출석체크이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (249,1,'2010-12-06',6,1,1,0.5,'12월사은행사 DM 코딩요청');
INSERT INTO mp_work_data VALUES (250,1,'2010-12-08',6,1,1,2.0,'즉석복권이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (251,1,'2010-12-08',6,1,1,1.0,'친구추천DM 코딩요청');
INSERT INTO mp_work_data VALUES (252,1,'2010-12-09',6,1,1,1.0,'12월 2차 주말DM 코딩 요청');
INSERT INTO mp_work_data VALUES (253,1,'2010-12-10',6,1,1,1.0,'롯데임직원특가2차DM 코딩요청');
INSERT INTO mp_work_data VALUES (254,1,'2010-12-10',6,1,1,1.0,'임직원특가코드수정요청');
INSERT INTO mp_work_data VALUES (255,1,'2010-12-23',6,1,1,1.0,'12월 4차 주말DM 코딩 요청안');
INSERT INTO mp_work_data VALUES (256,1,'2010-12-27',6,1,1,3.0,'새해분위기변경');
INSERT INTO mp_work_data VALUES (257,1,'2010-12-28',6,1,1,1.5,'1월영수증이벤트');
INSERT INTO mp_work_data VALUES (258,1,'2010-12-01',6,2,1,1.0,'임직원특가비정기DM');
INSERT INTO mp_work_data VALUES (259,1,'2010-12-08',6,2,1,1.5,'12월2주차 정기DM');
INSERT INTO mp_work_data VALUES (260,1,'2010-12-15',6,2,1,1.5,'12월3주차 정기DM');
INSERT INTO mp_work_data VALUES (261,1,'2010-12-16',6,2,1,1.0,'12월3주차 주말DM');
INSERT INTO mp_work_data VALUES (262,1,'2010-12-22',6,2,1,1.5,'12월4주차 정기DM');
INSERT INTO mp_work_data VALUES (263,1,'2010-12-29',6,2,1,1.5,'12월5주차 정기DM');
INSERT INTO mp_work_data VALUES (264,1,'2010-12-30',6,2,1,1.0,'12월5주차 주말DM');
INSERT INTO mp_work_data VALUES (265,1,'2010-12-01',10,1,1,0.5,'DM 코딩 수정요청');
INSERT INTO mp_work_data VALUES (266,1,'2010-12-02',10,1,1,1.5,'나만의 스타일 비법 롯데only - 수정!');
INSERT INTO mp_work_data VALUES (267,1,'2010-12-29',10,1,1,1.5,'43호 상품이미지 업로드 요청');
INSERT INTO mp_work_data VALUES (268,1,'2010-12-14',10,2,1,1.0,'플레어 42호  DM');
INSERT INTO mp_work_data VALUES (269,1,'2010-12-08',11,2,1,0.5,'영문 파이낸셜 리포트 업데이트');
INSERT INTO mp_work_data VALUES (270,1,'2010-12-16',11,1,1,2.0,'영문, 일문 페이지 수정');
INSERT INTO mp_work_data VALUES (271,1,'2010-12-01',12,1,1,1.0,'매뉴얼 다운로드 파일첨부 수정');
INSERT INTO mp_work_data VALUES (272,1,'2010-12-03',12,1,1,1.0,'조직도 수정요청');
INSERT INTO mp_work_data VALUES (273,1,'2010-12-10',12,1,1,1.0,'풋터영역 수정요청 드립니다.');
INSERT INTO mp_work_data VALUES (274,1,'2010-12-02',7,1,1,1.5,'신규입점_제천점 오픈');
INSERT INTO mp_work_data VALUES (275,1,'2010-12-10',7,1,1,1.0,'관계사 링크 수정');
INSERT INTO mp_work_data VALUES (276,1,'2010-12-20',7,1,1,1.5,'신규지점 오픈_1건(변경됨)');
INSERT INTO mp_work_data VALUES (277,1,'2010-12-22',7,1,1,1.0,'관계사 링크추가');
INSERT INTO mp_work_data VALUES (278,1,'2010-12-29',7,1,1,1.5,'신규지점 오픈');
INSERT INTO mp_work_data VALUES (279,1,'2010-12-29',7,1,1,2.0,'디지털파크전단_팝업변경');
INSERT INTO mp_work_data VALUES (280,1,'2010-12-30',7,2,1,1.0,'디지털파크전단_팝업변경');
INSERT INTO mp_work_data VALUES (281,1,'2010-12-31',7,1,1,1.5,'메인페이지/사이트맵 수정');
INSERT INTO mp_work_data VALUES (282,1,'2010-12-10',8,1,1,1.0,'풋터영역 수정요청 드립니다.');
INSERT INTO mp_work_data VALUES (283,1,'2010-12-28',8,1,1,1.5,'김해점 당첨자 발표 코딩요청');
INSERT INTO mp_work_data VALUES (284,1,'2010-12-16',8,2,1,1.5,'12월 16일 광주,수완DM');
INSERT INTO mp_work_data VALUES (285,1,'2010-12-20',9,1,1,1.0,'신규지점_1건 요청드립니다.(변경됨)');
INSERT INTO mp_work_data VALUES (286,1,'2010-12-29',9,1,1,1.0,'신규 지점 오픈');
INSERT INTO mp_work_data VALUES (287,1,'2010-11-01',1,1,1,1.0,'닷컴메일 하단 푸터정보 변경');
INSERT INTO mp_work_data VALUES (288,1,'2010-11-02',1,2,1,1.0,'문화센터 팝업 (28개점)');
INSERT INTO mp_work_data VALUES (289,1,'2010-11-02',1,1,1,2.0,'31주년 기념 \"촛불끄기\" 이벤트');
INSERT INTO mp_work_data VALUES (290,1,'2010-11-03',1,1,1,1.5,'고객의견 코딩 수정요청');
INSERT INTO mp_work_data VALUES (291,1,'2010-11-03',1,1,1,1.0,'31주년 영패션 위크');
INSERT INTO mp_work_data VALUES (292,1,'2010-11-03',1,1,1,1.5,'동티모르 어린이돕기 캠페인 이벤트, 메인팝업 코딩요청');
INSERT INTO mp_work_data VALUES (293,1,'2010-11-04',1,1,1,1.5,'신규회원 감사품 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (294,1,'2010-11-04',1,1,1,0.5,'멤버스DC존 메뉴 삭제 요청의 건');
INSERT INTO mp_work_data VALUES (295,1,'2010-11-04',1,1,1,2.0,'31주년 사은행사, 축하메시지 페이지 코딩요청');
INSERT INTO mp_work_data VALUES (296,1,'2010-11-05',1,1,1,1.0,'고객의견 페이지 배너 추가');
INSERT INTO mp_work_data VALUES (297,1,'2010-11-05',1,1,1,1.0,'아이러브 전주 코딩요청');
INSERT INTO mp_work_data VALUES (298,1,'2010-11-08',1,1,1,0.5,'아이러브 전주 코딩 수정요청');
INSERT INTO mp_work_data VALUES (299,1,'2010-11-08',1,1,1,0.5,'11월 홈페이지 신규회원 감사품 이벤트 팝업 코딩요청');
INSERT INTO mp_work_data VALUES (300,1,'2010-11-08',1,1,1,3.0,'역사편지쓰기 공모전 코딩요청');
INSERT INTO mp_work_data VALUES (301,1,'2010-11-08',1,1,1,1.0,'연탄기부 트위터 이벤트 당첨발표');
INSERT INTO mp_work_data VALUES (302,1,'2010-11-08',1,1,1,1.0,'웨딩센터 층 정보 변경');
INSERT INTO mp_work_data VALUES (303,1,'2010-11-08',1,1,1,2.0,'그린롯데 캐릭터 애니메이션/카툰 공모전 코딩요청');
INSERT INTO mp_work_data VALUES (304,1,'2010-11-09',1,1,1,0.5,'그린롯데 캐릭터 애니메이션/카툰 공모전 코딩 수정요청');
INSERT INTO mp_work_data VALUES (305,1,'2010-11-09',1,1,1,0.5,'메인 팝업');
INSERT INTO mp_work_data VALUES (306,1,'2010-11-09',1,1,1,0.5,'후드 패딩 페스티벌 코딩요청');
INSERT INTO mp_work_data VALUES (307,1,'2010-11-10',1,1,1,0.5,'전용기 타고 괌에 콘서트 보러가자 이벤트 코딩');
INSERT INTO mp_work_data VALUES (308,1,'2010-11-10',1,1,1,0.5,'신규회원 감사품 이벤트 코딩 수정요청');
INSERT INTO mp_work_data VALUES (309,1,'2010-11-11',1,1,1,5.0,'모아모아 할인쿠폰 출력 이벤트');
INSERT INTO mp_work_data VALUES (310,1,'2010-11-11',1,1,1,0.5,'위드유 마일리지 일시중지 안내 팝업 코딩요청');
INSERT INTO mp_work_data VALUES (311,1,'2010-11-11',1,2,1,3.0,'상인점 UCC이벤트');
INSERT INTO mp_work_data VALUES (312,1,'2010-11-12',1,2,1,1.0,'대구영플 팝업');
INSERT INTO mp_work_data VALUES (313,1,'2010-11-12',1,2,1,1.0,'VIP 프로그램 서브메뉴 복구');
INSERT INTO mp_work_data VALUES (314,1,'2010-11-12',1,2,1,0.5,'백화점 휴점안내 팝업');
INSERT INTO mp_work_data VALUES (315,1,'2010-11-12',1,1,1,0.5,'팝업요청');
INSERT INTO mp_work_data VALUES (316,1,'2010-11-15',1,1,1,1.0,'모아모아 이벤트 코딩수정요청');
INSERT INTO mp_work_data VALUES (317,1,'2010-11-15',1,1,1,0.5,'모바일백화점내 상품권 구입 버튼 삭제');
INSERT INTO mp_work_data VALUES (318,1,'2010-11-16',1,2,1,0.5,'롯데백화점에서 UFO를 잡아라 이벤트');
INSERT INTO mp_work_data VALUES (319,1,'2010-11-16',1,2,1,0.5,'메인 팝업');
INSERT INTO mp_work_data VALUES (320,1,'2010-11-16',1,1,1,0.5,'31주년 케익 인트로 종료요청');
INSERT INTO mp_work_data VALUES (321,1,'2010-11-16',1,1,1,1.0,'모아모아 쿠폰출력 이벤트');
INSERT INTO mp_work_data VALUES (322,1,'2010-11-16',1,1,1,2.0,'영플라자 브랜드 블로그');
INSERT INTO mp_work_data VALUES (323,1,'2010-11-16',1,1,1,0.5,'뮤지컬 오디션 이벤트 당첨발표');
INSERT INTO mp_work_data VALUES (324,1,'2010-11-16',1,2,1,0.5,'위드유 마일리지 코딩 수정');
INSERT INTO mp_work_data VALUES (325,1,'2010-11-18',1,2,1,0.5,'부산본점 팝업');
INSERT INTO mp_work_data VALUES (326,1,'2010-11-18',1,2,1,0.5,'대구영플 팝업');
INSERT INTO mp_work_data VALUES (327,1,'2010-11-18',1,1,1,0.5,'메인 팝업 코딩요청');
INSERT INTO mp_work_data VALUES (328,1,'2010-11-18',1,1,1,0.5,'유명브랜드 세일 코딩요청');
INSERT INTO mp_work_data VALUES (329,1,'2010-11-18',1,1,1,0.5,'영플라자 브랜드 블로그 배너 링크작업');
INSERT INTO mp_work_data VALUES (330,1,'2010-11-18',1,1,1,0.5,'롯데백화점에서 UFO를 잡아라 이벤트 코딩수정, 팝업요청');
INSERT INTO mp_work_data VALUES (331,1,'2010-11-18',1,2,1,0.5,'센텀시티점 팝업 (퍼플카우 팝업 추가)');
INSERT INTO mp_work_data VALUES (332,1,'2010-11-19',1,1,1,3.0,'문화홀 메인 오늘의 공연 수정 작업요청');
INSERT INTO mp_work_data VALUES (333,1,'2010-11-19',1,1,1,2.0,'브랜드 블로그 서브메뉴');
INSERT INTO mp_work_data VALUES (334,1,'2010-11-19',1,1,1,2.0,'사회적 책임 페이지 수정');
INSERT INTO mp_work_data VALUES (335,1,'2010-11-23',1,1,1,0.5,'롯데상품권 사용안내 링크 주소 수정');
INSERT INTO mp_work_data VALUES (336,1,'2010-11-23',1,2,1,0.5,'상품권 판매소 연락처 추가');
INSERT INTO mp_work_data VALUES (337,1,'2010-11-24',1,1,1,1.0,'듀오웨딩 페스티벌 (페이지, 팝업)');
INSERT INTO mp_work_data VALUES (338,1,'2010-11-24',1,2,1,1.0,'톨스토이 영화 시사회 초대전');
INSERT INTO mp_work_data VALUES (339,1,'2010-11-25',1,1,1,1.5,'문화홀 메인 오늘의 공연 수정 작업요청');
INSERT INTO mp_work_data VALUES (340,1,'2010-11-25',1,1,1,0.5,'브랜드 블로그 리스트 항목명 이미지 수정');
INSERT INTO mp_work_data VALUES (341,1,'2010-11-25',1,1,1,2.0,'프리미엄세일 세일 하이라이트');
INSERT INTO mp_work_data VALUES (342,1,'2010-11-25',1,1,1,0.5,'프리미엄세일 주말구매고객 사은');
INSERT INTO mp_work_data VALUES (343,1,'2010-11-25',1,1,1,0.5,'세일 해외명품 구매사은 페이지 코딩요청');
INSERT INTO mp_work_data VALUES (344,1,'2010-11-25',1,1,1,0.5,'세일 인덱스 코딩 요청');
INSERT INTO mp_work_data VALUES (345,1,'2010-11-25',1,1,1,0.5,'제라르다렐 지점 팝업 코딩요청');
INSERT INTO mp_work_data VALUES (346,1,'2010-11-26',1,1,1,0.5,'셀렉티드샵 메뉴(브랜드) 삭제');
INSERT INTO mp_work_data VALUES (347,1,'2010-11-26',1,1,1,0.5,'톨스토이 이벤트 코딩수정');
INSERT INTO mp_work_data VALUES (348,1,'2010-11-26',1,1,1,0.5,'듀오웨딩 페스티벌 페이지 수정(버튼링크)');
INSERT INTO mp_work_data VALUES (349,1,'2010-11-29',1,1,1,0.5,'본점,잠실점 팝업 수정');
INSERT INTO mp_work_data VALUES (350,1,'2010-11-30',1,1,1,3.0,'롯데멤버스 통합 영수증 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (351,1,'2010-11-30',1,1,1,0.5,'문화홀 공연소개 썸네일 사이즈 변경 요청');
INSERT INTO mp_work_data VALUES (352,1,'2010-11-30',1,1,1,0.5,'지속가능 경영 영문 파일 교체');
INSERT INTO mp_work_data VALUES (353,1,'2010-11-30',1,1,1,0.5,'상품권 사용장소 추가');
INSERT INTO mp_work_data VALUES (354,1,'2010-11-30',1,1,1,0.5,'11월 영수증 이벤트 팝업 게시 종료요청');
INSERT INTO mp_work_data VALUES (355,1,'2010-11-04',1,2,1,1.5,'11월 1주 정기DM');
INSERT INTO mp_work_data VALUES (356,1,'2010-11-11',1,2,1,1.5,'11월 2주 정기DM');
INSERT INTO mp_work_data VALUES (357,1,'2010-11-18',1,2,1,1.5,'11월 3주 정기DM');
INSERT INTO mp_work_data VALUES (358,1,'2010-11-25',1,2,1,1.5,'11월 4주 정기DM');
INSERT INTO mp_work_data VALUES (359,1,'2010-11-01',2,2,1,0.5,'5시간전샵 레이어팝업');
INSERT INTO mp_work_data VALUES (360,1,'2010-11-01',2,1,1,0.5,'웨딩 상단 네비 작업요청');
INSERT INTO mp_work_data VALUES (361,1,'2010-11-01',2,1,1,0.5,'웨딩리마인드 쿠폰 코딩');
INSERT INTO mp_work_data VALUES (362,1,'2010-11-01',2,1,1,0.5,'sk텔링크이벤트페이지 코딩수정요청');
INSERT INTO mp_work_data VALUES (363,1,'2010-11-02',2,2,1,0.5,'정기세일 페이지 링크수정');
INSERT INTO mp_work_data VALUES (364,1,'2010-11-02',2,2,1,1.0,'외국인특별쿠폰 수정');
INSERT INTO mp_work_data VALUES (365,1,'2010-11-03',2,2,1,1.5,'비오템 퀴즈사은 이벤트 코딩');
INSERT INTO mp_work_data VALUES (366,1,'2010-11-03',2,1,1,1.0,'부부팀 구매왕 페이지 수정');
INSERT INTO mp_work_data VALUES (367,1,'2010-11-04',2,1,1,0.5,'하나은행 페이지수정 코딩요청');
INSERT INTO mp_work_data VALUES (368,1,'2010-11-05',2,1,1,1.5,'끼리끼리 구매왕 이벤트');
INSERT INTO mp_work_data VALUES (369,1,'2010-11-05',2,2,1,1.0,'롯데 & 5시간전샵 퀴즈 이벤트');
INSERT INTO mp_work_data VALUES (370,1,'2010-11-08',2,1,1,1.0,'부부팀 구매왕 수정요청');
INSERT INTO mp_work_data VALUES (371,1,'2010-11-08',2,1,1,1.0,'5시간전샵 레이어팝업 코딩요청');
INSERT INTO mp_work_data VALUES (372,1,'2010-11-08',2,1,1,2.0,'쇼핑백서 관리툴 개발');
INSERT INTO mp_work_data VALUES (373,1,'2010-11-08',2,1,1,1.5,'페라리 구매왕이벤트');
INSERT INTO mp_work_data VALUES (374,1,'2010-11-08',2,1,1,3.5,'고객의 소리를 들려주세요 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (375,1,'2010-11-09',2,1,1,1.5,'롯데카드 포인트 증정 이벤트');
INSERT INTO mp_work_data VALUES (376,1,'2010-11-09',2,1,1,2.0,'메가이벤트 9기 이벤트 코딩');
INSERT INTO mp_work_data VALUES (377,1,'2010-11-09',2,1,1,0.5,'끼리끼리 구매왕 이벤트 팝업 수정');
INSERT INTO mp_work_data VALUES (378,1,'2010-11-10',2,2,1,1.0,'롯데포인트 최대 100% 캐시백 이벤트');
INSERT INTO mp_work_data VALUES (379,1,'2010-11-10',2,2,1,0.5,'첫구매 신규회원 1만포인트 지급 이벤트');
INSERT INTO mp_work_data VALUES (380,1,'2010-11-10',2,2,1,3.0,'쇼핑후기 URL등록 이벤트 코딩');
INSERT INTO mp_work_data VALUES (381,1,'2010-11-11',2,2,1,1.0,'끼리끼리 구매왕 이벤트 수정');
INSERT INTO mp_work_data VALUES (382,1,'2010-11-11',2,1,1,1.0,'FAQ 부분 수정');
INSERT INTO mp_work_data VALUES (383,1,'2010-11-11',2,1,1,0.5,'메인 레이어 팝업');
INSERT INTO mp_work_data VALUES (384,1,'2010-11-11',2,1,1,0.5,'롯데카드 포인트 증정 이벤트 수정요청');
INSERT INTO mp_work_data VALUES (385,1,'2010-11-11',2,1,1,1.0,'롯데포인트 인덱스 네비 코딩요청');
INSERT INTO mp_work_data VALUES (386,1,'2010-11-11',2,1,1,0.5,'웨딩페어 인덱스페이지 수정');
INSERT INTO mp_work_data VALUES (387,1,'2010-11-11',2,1,1,0.5,'롯데카드 이벤트 링크 수정요청');
INSERT INTO mp_work_data VALUES (388,1,'2010-11-12',2,1,1,1.0,'끼리끼리 이벤트 코딩수정요청');
INSERT INTO mp_work_data VALUES (389,1,'2010-11-12',2,1,1,1.0,'원앤원 페이지 내부 레이어 팝업 추가');
INSERT INTO mp_work_data VALUES (390,1,'2010-11-15',2,2,1,0.5,'포인트 혜택 네비 수정');
INSERT INTO mp_work_data VALUES (391,1,'2010-11-15',2,1,1,3.0,'고객님의 소리를 들려주세요 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (392,1,'2010-11-18',2,2,1,1.0,'국내패션잡화브랜드 아이콘 코딩');
INSERT INTO mp_work_data VALUES (393,1,'2010-11-18',2,1,1,1.5,'이벤트페이지 상단네비 코딩요청');
INSERT INTO mp_work_data VALUES (394,1,'2010-11-19',2,2,1,1.0,'패션잡화/시계 구매시 화장품 향수 50% 할인 쿠폰');
INSERT INTO mp_work_data VALUES (395,1,'2010-11-19',2,2,1,0.5,'주문/결제 2단계 주문서작성 페이지 수정');
INSERT INTO mp_work_data VALUES (396,1,'2010-11-19',2,2,1,1.0,'메트로씨티 구매왕 코딩요청');
INSERT INTO mp_work_data VALUES (397,1,'2010-11-22',2,1,1,1.0,'텐텐텐 이벤트 당첨자발표 요청');
INSERT INTO mp_work_data VALUES (398,1,'2010-11-23',2,1,1,0.5,'하나은행 페이지 수정요청');
INSERT INTO mp_work_data VALUES (399,1,'2010-11-23',2,1,1,0.5,'10주년 한줄축하이벤트 당첨자발표요청');
INSERT INTO mp_work_data VALUES (400,1,'2010-11-23',2,2,1,1.0,'MVG 등업 이벤트');
INSERT INTO mp_work_data VALUES (401,1,'2010-11-24',2,2,1,2.0,'신한카드 이벤트 코딩');
INSERT INTO mp_work_data VALUES (402,1,'2010-11-24',2,2,1,1.0,'레이어팝업 코딩');
INSERT INTO mp_work_data VALUES (403,1,'2010-11-24',2,1,1,0.5,'10주년 한줄축하이벤트 당첨자발표 코딩수정요청');
INSERT INTO mp_work_data VALUES (404,1,'2010-11-25',2,1,1,0.5,'12월 하나은행 쿠폰 코딩요청');
INSERT INTO mp_work_data VALUES (405,1,'2010-11-25',2,1,1,0.5,'하나은행 페이지 내에 게시될 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (406,1,'2010-11-25',2,1,1,0.5,'닷컴플래티넘 쿠폰 이벤트');
INSERT INTO mp_work_data VALUES (407,1,'2010-11-25',2,1,1,0.5,'웨딩리마인드 쿠폰 코딩 요청');
INSERT INTO mp_work_data VALUES (408,1,'2010-11-26',2,1,1,0.5,'12월 아시아나 쿠폰 이벤트');
INSERT INTO mp_work_data VALUES (409,1,'2010-11-26',2,1,1,0.5,'끼리끼리이벤트 당첨자발표');
INSERT INTO mp_work_data VALUES (410,1,'2010-11-29',2,1,1,0.5,'메인페이지 링크수정요청');
INSERT INTO mp_work_data VALUES (411,1,'2010-11-29',2,1,1,0.5,'멤버쉽 안내 링크교체 요청');
INSERT INTO mp_work_data VALUES (412,1,'2010-11-30',2,1,1,0.5,'웨딩 리마인드 쿠폰 12월자');
INSERT INTO mp_work_data VALUES (413,1,'2010-11-30',2,1,1,1.0,'고객센터 수정요청');
INSERT INTO mp_work_data VALUES (414,1,'2010-11-30',2,1,1,0.5,'고객센터내의 회원약관 수정요청');
INSERT INTO mp_work_data VALUES (415,1,'2010-11-30',2,1,1,0.5,'메트로시티 구매왕이벤트 버튼 추가요청');
INSERT INTO mp_work_data VALUES (416,1,'2010-11-30',2,1,1,1.5,'메인 상단GNB영역 코딩 수정요청');
INSERT INTO mp_work_data VALUES (417,1,'2010-11-30',2,1,1,2.0,'포인트관련 이벤트 상단 네비영역 수정요청');
INSERT INTO mp_work_data VALUES (418,1,'2010-11-30',2,1,1,2.0,'10주년 기념 신규가입,첫구매 당첨자발표');
INSERT INTO mp_work_data VALUES (419,1,'2010-11-01',2,2,1,1.5,'11월3일자 정기DM');
INSERT INTO mp_work_data VALUES (420,1,'2010-11-01',2,2,1,0.5,'11월2일자 재구매, 첫구매DM 수정');
INSERT INTO mp_work_data VALUES (421,1,'2010-11-04',2,1,1,0.5,'11월 1일자 DM 수정');
INSERT INTO mp_work_data VALUES (422,1,'2010-11-05',2,2,1,1.5,'11월8일자 정기DM');
INSERT INTO mp_work_data VALUES (423,1,'2010-11-11',2,1,1,1.5,'11월 15일자 정기DM');
INSERT INTO mp_work_data VALUES (424,1,'2010-11-12',2,2,1,1.5,'11월17일자 정기DM');
INSERT INTO mp_work_data VALUES (425,1,'2010-11-12',2,2,1,0.5,'11월15일자 정기DM 수정');
INSERT INTO mp_work_data VALUES (426,1,'2010-11-12',2,2,1,0.5,'11월17일자 플래티늄DM 수정');
INSERT INTO mp_work_data VALUES (427,1,'2010-11-15',2,2,1,1.5,'11월17일자 우수회원DM');
INSERT INTO mp_work_data VALUES (428,1,'2010-11-16',2,1,1,0.5,'11월 17일자 DM 수정');
INSERT INTO mp_work_data VALUES (429,1,'2010-11-22',2,2,1,1.5,'11월24일자 정기DM');
INSERT INTO mp_work_data VALUES (430,1,'2010-11-23',2,1,1,0.5,'11월 24일자 정기DM 수정');
INSERT INTO mp_work_data VALUES (431,1,'2010-11-26',2,2,1,1.5,'11월29일자 정기DM');
INSERT INTO mp_work_data VALUES (432,1,'2010-11-26',2,2,1,1.0,'12월1일자 플래티늄 DM 2건');
INSERT INTO mp_work_data VALUES (433,1,'2010-11-04',3,2,1,0.5,'온라인샵 브랜드 추가');
INSERT INTO mp_work_data VALUES (434,1,'2010-11-04',3,2,1,1.0,'우수회원 등업 이벤트');
INSERT INTO mp_work_data VALUES (435,1,'2010-11-04',3,1,1,2.0,'청첩장 등록 개선');
INSERT INTO mp_work_data VALUES (436,1,'2010-11-04',3,1,1,1.0,'더블적립 아이콘 코딩 요청(디자인자료 첨부)');
INSERT INTO mp_work_data VALUES (437,1,'2010-11-09',3,1,1,2.0,'메가이벤트 9기_푸켓 로맨틱 커플 여행');
INSERT INTO mp_work_data VALUES (438,1,'2010-11-12',3,2,1,1.0,'출국 7일전 서프라이즈 쿠폰 발송 이벤트');
INSERT INTO mp_work_data VALUES (439,1,'2010-11-16',3,2,1,1.0,'11월 3주차 주말할인 쿠폰');
INSERT INTO mp_work_data VALUES (440,1,'2010-11-25',3,1,1,2.0,'크리스마스 트리에 불이켜지면');
INSERT INTO mp_work_data VALUES (441,1,'2010-11-25',3,2,1,3.0,'12월쿠폰 (크리스마스, 첫구매, 대박지원금)');
INSERT INTO mp_work_data VALUES (442,1,'2010-11-26',3,2,1,0.5,'웨딩샵 메인 코딩');
INSERT INTO mp_work_data VALUES (443,1,'2010-11-02',3,2,1,1.5,'11월 4일 정기DM');
INSERT INTO mp_work_data VALUES (444,1,'2010-11-15',3,2,1,1.5,'11월 16일 정기DM');
INSERT INTO mp_work_data VALUES (445,1,'2010-11-18',4,2,1,1.5,'니하오중국_구매사은');
INSERT INTO mp_work_data VALUES (446,1,'2010-11-18',4,2,1,1.5,'니하오중국_특별할인쿠폰');
INSERT INTO mp_work_data VALUES (447,1,'2010-11-18',4,2,1,2.5,'니하오중국_친구추천이벤트');
INSERT INTO mp_work_data VALUES (448,1,'2010-11-18',4,2,1,2.5,'니하오중국_스탬프');
INSERT INTO mp_work_data VALUES (449,1,'2010-11-19',4,1,1,0.5,'코엑스 중국인 DM 수정요청');
INSERT INTO mp_work_data VALUES (450,1,'2010-11-24',4,1,1,1.0,'중국인 회원 대상_친구 추천 이벤트_수정');
INSERT INTO mp_work_data VALUES (451,1,'2010-11-26',4,2,1,1.0,'더블적립 이벤트');
INSERT INTO mp_work_data VALUES (452,1,'2010-11-26',4,2,1,1.0,'정관행사 이벤트');
INSERT INTO mp_work_data VALUES (453,1,'2010-11-15',4,2,1,1.5,'11월 16일자 정기DM');
INSERT INTO mp_work_data VALUES (454,1,'2010-11-19',4,2,1,1.0,'라네즈DM');
INSERT INTO mp_work_data VALUES (455,1,'2010-11-23',4,2,1,1.0,'중국인대상DM');
INSERT INTO mp_work_data VALUES (456,1,'2010-11-01',5,1,1,1.0,'팝업노출요청');
INSERT INTO mp_work_data VALUES (457,1,'2010-11-01',5,1,1,1.0,'메인팝업 교체요청');
INSERT INTO mp_work_data VALUES (458,1,'2010-11-02',5,2,1,0.5,'팝업노출');
INSERT INTO mp_work_data VALUES (459,1,'2010-11-03',5,1,1,1.0,'이벤트안내 코딩요청');
INSERT INTO mp_work_data VALUES (460,1,'2010-11-04',5,2,1,1.0,'영문,중문 사이트 텍스트수정');
INSERT INTO mp_work_data VALUES (461,1,'2010-11-09',5,1,1,0.5,'이벤트카달로그페이지 코딩요청');
INSERT INTO mp_work_data VALUES (462,1,'2010-11-11',5,1,1,1.0,'메인팝업 코딩 외 1건 코딩요청');
INSERT INTO mp_work_data VALUES (463,1,'2010-11-12',5,1,1,0.5,'메인 팝업교체요청');
INSERT INTO mp_work_data VALUES (464,1,'2010-11-17',5,1,1,3.0,'지점별 푸터 수정요청');
INSERT INTO mp_work_data VALUES (465,1,'2010-11-18',5,2,1,1.0,'인천공항면세점할인쿠폰');
INSERT INTO mp_work_data VALUES (466,1,'2010-11-22',5,2,1,0.5,'매거진회원 할인쿠폰 이미지 교체');
INSERT INTO mp_work_data VALUES (467,1,'2010-11-23',5,2,1,0.5,'텍스트 수정');
INSERT INTO mp_work_data VALUES (468,1,'2010-11-25',5,2,1,1.0,'코딩 수정');
INSERT INTO mp_work_data VALUES (469,1,'2010-11-25',5,1,1,1.0,'코딩 수정요청');
INSERT INTO mp_work_data VALUES (470,1,'2010-11-30',5,1,1,1.0,'vip회원정보 페이지 수정요청');
INSERT INTO mp_work_data VALUES (471,1,'2010-11-12',5,2,1,1.5,'[중문] 11월15일');
INSERT INTO mp_work_data VALUES (472,1,'2010-11-15',5,2,1,1.5,'[국문] 11월 17일');
INSERT INTO mp_work_data VALUES (473,1,'2010-11-01',5,2,1,0.5,'[일문] 11월 월간랭킹 수정');
INSERT INTO mp_work_data VALUES (474,1,'2010-11-01',5,1,1,0.5,'[일문] 일문사이트 텍스트 수정');
INSERT INTO mp_work_data VALUES (475,1,'2010-11-02',5,2,1,0.5,'[일문] 코엑스점 한국어맵 이미지 교체');
INSERT INTO mp_work_data VALUES (476,1,'2010-11-03',5,2,1,0.5,'[일문] 세일행사 서브페이지 하단배너 코딩');
INSERT INTO mp_work_data VALUES (477,1,'2010-11-03',5,1,1,0.5,'[일문] 일문사이트 텍스트 수정');
INSERT INTO mp_work_data VALUES (478,1,'2010-11-05',5,1,1,1.0,'[일문] 이벤트 카달로그 추가');
INSERT INTO mp_work_data VALUES (479,1,'2010-11-05',5,1,1,0.5,'[일문] 일문사이트 텍스트 수정');
INSERT INTO mp_work_data VALUES (480,1,'2010-11-11',5,1,1,1.0,'[일문] 메인배너 코딩');
INSERT INTO mp_work_data VALUES (481,1,'2010-11-11',5,1,1,0.5,'[일문] 이벤트 카달로그 링크변경');
INSERT INTO mp_work_data VALUES (482,1,'2010-11-12',5,1,1,0.5,'[일문] 공지사항 링크수정');
INSERT INTO mp_work_data VALUES (483,1,'2010-11-12',5,1,1,1.5,'[일문] 영업시간 및 지점추가');
INSERT INTO mp_work_data VALUES (484,1,'2010-11-16',5,2,1,1.0,'[일문] 부산점 카달로그추가');
INSERT INTO mp_work_data VALUES (485,1,'2010-11-16',5,2,1,1.0,'[일문] 세일이벤트페이지? 링크이미지추가');
INSERT INTO mp_work_data VALUES (486,1,'2010-11-18',5,1,1,0.5,'[일문] 일문사이트 텍스트 수정');
INSERT INTO mp_work_data VALUES (487,1,'2010-11-19',5,1,1,1.0,'[일문] 코엑스점 이미지 교체 및 텍스트 수정');
INSERT INTO mp_work_data VALUES (488,1,'2010-11-22',5,1,1,1.5,'[일문] 옴므 11월호');
INSERT INTO mp_work_data VALUES (489,1,'2010-11-22',5,2,1,1.0,'[일문] 매거진회원 할인쿠폰 이미지 교체');
INSERT INTO mp_work_data VALUES (490,1,'2010-11-26',5,2,1,1.0,'[일문] 12월 월간랭킹 수정');
INSERT INTO mp_work_data VALUES (491,1,'2010-11-26',5,1,1,0.5,'[일문] 월드점 약도 이미지교체');
INSERT INTO mp_work_data VALUES (492,1,'2010-11-29',5,1,1,0.5,'[일문] 쿠폰이미지 교체');
INSERT INTO mp_work_data VALUES (493,1,'2010-11-30',5,1,1,0.5,'[일문] 일문사이트 텍스트 수정');
INSERT INTO mp_work_data VALUES (494,1,'2010-11-11',5,2,1,2.0,'[일문] 11월12일 모바일, 전자메일');
INSERT INTO mp_work_data VALUES (495,1,'2010-11-23',5,2,1,2.0,'[일문] 11월25일 모바일, 전자메일');
INSERT INTO mp_work_data VALUES (496,1,'2010-11-02',6,2,1,0.5,'오픈1주년 이벤트종료에 따른 수정');
INSERT INTO mp_work_data VALUES (497,1,'2010-11-11',6,1,1,2.0,'잔류농약속성검사 안내문 수정안');
INSERT INTO mp_work_data VALUES (498,1,'2010-11-15',6,1,1,1.0,'롯데슈퍼메인여백수정');
INSERT INTO mp_work_data VALUES (499,1,'2010-11-15',6,1,1,1.0,'롯데슈퍼내 롯데JTB 로고추가코딩요청');
INSERT INTO mp_work_data VALUES (500,1,'2010-11-16',6,1,1,1.0,'오픈1주년內이벤트3 선착순이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (501,1,'2010-11-25',6,1,1,1.0,'롯데닷컴내 슈퍼사이트 수정');
INSERT INTO mp_work_data VALUES (502,1,'2010-11-26',6,2,1,1.0,'12월영수증이벤트코딩');
INSERT INTO mp_work_data VALUES (503,1,'2010-11-03',6,2,1,1.5,'11월 1주차 일반,택배몰 DM');
INSERT INTO mp_work_data VALUES (504,1,'2010-11-04',6,2,1,1.0,'11월 1주차 주말쿠폰DM');
INSERT INTO mp_work_data VALUES (505,1,'2010-11-10',6,2,1,1.5,'11월 2주차 일반,택배몰 DM');
INSERT INTO mp_work_data VALUES (506,1,'2010-11-11',6,2,1,1.0,'11월 2주차 주말쿠폰DM');
INSERT INTO mp_work_data VALUES (507,1,'2010-11-11',6,2,1,1.0,'생활용품 단독DM');
INSERT INTO mp_work_data VALUES (508,1,'2010-11-17',6,2,1,1.5,'11월 3주차 일반,택배몰 DM');
INSERT INTO mp_work_data VALUES (509,1,'2010-11-18',6,2,1,1.0,'11월 3주차 주말쿠폰DM');
INSERT INTO mp_work_data VALUES (510,1,'2010-11-24',6,2,1,1.5,'11월 4주차 일반,택배몰 DM');
INSERT INTO mp_work_data VALUES (511,1,'2010-11-25',6,2,1,1.0,'11월 4주차 주말쿠폰DM');
INSERT INTO mp_work_data VALUES (512,1,'2010-11-26',10,1,1,1.0,'상품이미지 업로드 요청');
INSERT INTO mp_work_data VALUES (513,1,'2010-11-29',10,1,1,3.0,'겨울스킨 변경 관련 안내');
INSERT INTO mp_work_data VALUES (514,1,'2010-11-02',10,2,1,1.5,'플레어 39호 DM');
INSERT INTO mp_work_data VALUES (515,1,'2010-11-16',10,2,1,1.5,'플레어 40호 DM');
INSERT INTO mp_work_data VALUES (516,1,'2010-11-22',11,1,1,1.0,'IR 실적자료 파일 교체');
INSERT INTO mp_work_data VALUES (517,1,'2010-11-02',12,2,1,0.5,'링크 수정');
INSERT INTO mp_work_data VALUES (518,1,'2010-11-05',12,1,1,1.0,'상담신청 시 팝업 요청');
INSERT INTO mp_work_data VALUES (519,1,'2010-11-19',12,2,1,0.5,'조직도 수정');
INSERT INTO mp_work_data VALUES (520,1,'2010-11-26',12,1,1,2.0,'페이지 수정');
INSERT INTO mp_work_data VALUES (521,1,'2010-11-09',7,1,1,0.5,'메인 스카이 배너 위치 수정');
INSERT INTO mp_work_data VALUES (522,1,'2010-11-10',7,1,1,1.0,'사이트 틀어짐 현상');
INSERT INTO mp_work_data VALUES (523,1,'2010-11-10',7,1,1,0.5,'다보증 서비스 파일 교체');
INSERT INTO mp_work_data VALUES (524,1,'2010-11-11',7,1,1,0.5,'해외점포 오픈_페이지 수정');
INSERT INTO mp_work_data VALUES (525,1,'2010-11-18',7,1,1,1.5,'신문광고_팝업추가및 링크변경');
INSERT INTO mp_work_data VALUES (526,1,'2010-11-22',7,1,1,0.5,'페이지 내 링크 수정');
INSERT INTO mp_work_data VALUES (527,1,'2010-11-25',7,1,1,1.0,'신규입점_11월 25일 오픈');
INSERT INTO mp_work_data VALUES (528,1,'2010-11-25',7,1,1,0.5,'레이어팝업 변경');
INSERT INTO mp_work_data VALUES (529,1,'2010-11-26',7,1,1,0.5,'지점명 변경');
INSERT INTO mp_work_data VALUES (530,1,'2010-11-02',8,2,1,1.0,'율하점 당첨자발표 코딩');
INSERT INTO mp_work_data VALUES (531,1,'2010-11-15',8,1,1,2.0,'GNB메뉴 수정요청');
INSERT INTO mp_work_data VALUES (532,1,'2010-11-19',8,2,1,1.0,'김해점 전경사진 수정');
INSERT INTO mp_work_data VALUES (533,1,'2010-11-30',8,1,1,4.0,'공통 풋터영역 채용안내 추가 요청');
INSERT INTO mp_work_data VALUES (534,1,'2010-11-30',8,1,1,1.5,'광주점 DM');
INSERT INTO mp_work_data VALUES (535,1,'2010-11-03',8,1,1,1.5,'광주점 DM');
INSERT INTO mp_work_data VALUES (536,1,'2010-11-04',8,1,1,1.5,'수완점 DM');
INSERT INTO mp_work_data VALUES (537,1,'2010-11-01',13,1,1,0.5,'에비뉴엘 예정 휴점일 변경');
INSERT INTO mp_work_data VALUES (538,1,'2010-11-11',13,1,1,1.0,'에비뉴엘 플로어 가이드 10층 수정');
INSERT INTO mp_work_data VALUES (539,1,'2011-01-07',7,1,1,1.5,'설 선물상담 페이지 코딩');
INSERT INTO mp_work_data VALUES (540,1,'2011-01-11',7,1,2,1.0,'디지털파크 지점추가_비경건');
INSERT INTO mp_work_data VALUES (541,1,'2011-01-13',7,1,1,1.0,'디지털파크_전단링크 연결');
INSERT INTO mp_work_data VALUES (542,1,'2011-01-03',5,1,1,1.0,'[일문] 메인페이지 텍스트수정');
INSERT INTO mp_work_data VALUES (543,1,'2011-01-04',5,1,1,1.5,'[일문] GNB메뉴 상단배너 교체');
INSERT INTO mp_work_data VALUES (544,1,'2011-01-06',5,1,1,0.5,'[일문] 제휴배너 이미지교체');
INSERT INTO mp_work_data VALUES (545,1,'2011-01-13',5,1,1,1.5,'지점 메인 팝업 노출요청');
INSERT INTO mp_work_data VALUES (546,1,'2011-01-03',1,1,1,0.5,'샤갈전 이벤트 팝업 삭제 작업요청');
INSERT INTO mp_work_data VALUES (547,1,'2011-01-03',1,1,1,1.0,'샤갈전 이벤트 팝업 추가/수정 코딩 작업요청');
INSERT INTO mp_work_data VALUES (548,1,'2011-01-03',1,1,1,1.0,'위드유 마일리지 적립 중단으로 인한 코딩 수정요청');
INSERT INTO mp_work_data VALUES (549,1,'2011-01-03',1,1,1,0.5,'대구영플라자 휴점팝업 게재중지 요청');
INSERT INTO mp_work_data VALUES (550,1,'2011-01-03',1,1,1,1.0,'롯데백화점 새로운 얼굴 페이지 코딩 작업요청');
INSERT INTO mp_work_data VALUES (551,1,'2011-01-06',1,1,1,0.5,'대구영플 팝업 게재요청');
INSERT INTO mp_work_data VALUES (552,1,'2011-01-06',1,1,1,1.5,'1월1주차 정기dm');
INSERT INTO mp_work_data VALUES (553,1,'2011-01-06',1,1,1,1.0,'세일 TV동영상 페이지 코딩요청');
INSERT INTO mp_work_data VALUES (554,1,'2011-01-06',1,1,1,2.0,'샤롯데N 방송내용 줄바꿈 코딩 수정요청');
INSERT INTO mp_work_data VALUES (555,1,'2011-01-07',1,1,1,0.5,'샤갈전 이벤트 페이지 코딩 수정요청');
INSERT INTO mp_work_data VALUES (556,1,'2011-01-10',1,1,1,0.5,'샤갈전 이벤트 코딩 수정요청');
INSERT INTO mp_work_data VALUES (557,1,'2011-01-11',1,1,1,0.5,'메인팝업(스마트폰영화제안내)');
INSERT INTO mp_work_data VALUES (558,1,'2011-01-12',1,1,1,1.0,'상품권&카드 서브메인 배너 코딩 수정요청');
INSERT INTO mp_work_data VALUES (559,1,'2011-01-12',1,1,1,1.0,'천진점 홈페이지 인재모집 페이지 코딩요청');
INSERT INTO mp_work_data VALUES (560,1,'2011-01-13',1,1,1,2.0,'영문,중문,일문 페이지 팝업 코딩');
INSERT INTO mp_work_data VALUES (561,1,'2011-01-14',1,1,1,0.5,'분당점 상품권 데스크 층 수정');
INSERT INTO mp_work_data VALUES (562,1,'2011-01-14',1,1,1,0.5,'샤롯데N 팝업 방송내용 줄바꿈 코딩 수정요청');
INSERT INTO mp_work_data VALUES (563,1,'2011-01-12',12,1,1,1.0,'인사말 페이지 수정');
INSERT INTO mp_work_data VALUES (564,1,'2011-01-03',2,1,1,0.5,'1월 3일 정기 dm 종료행사 수정요청');
INSERT INTO mp_work_data VALUES (565,1,'2011-01-04',2,1,1,0.5,'웨딩샵 인덱스페이지 수정요청');
INSERT INTO mp_work_data VALUES (566,1,'2011-01-04',2,1,1,1.0,'네비 코딩요청');
INSERT INTO mp_work_data VALUES (567,1,'2011-01-04',2,1,1,1.0,'내인생첫구매DM');
INSERT INTO mp_work_data VALUES (568,1,'2011-01-04',2,1,1,2.0,'메트로 씨티 상품평 이벤트 작업요청');
INSERT INTO mp_work_data VALUES (569,1,'2011-01-06',2,1,1,0.5,'1월10일자 DM 수정요청');
INSERT INTO mp_work_data VALUES (570,1,'2011-01-06',2,1,1,1.0,'1월 6일 플래티늄 고지 재발송 DM 코딩요청');
INSERT INTO mp_work_data VALUES (571,1,'2011-01-07',2,1,1,1.5,'1월11일자 외국인 타겟 DM 코딩요청');
INSERT INTO mp_work_data VALUES (572,1,'2011-01-07',2,1,1,0.5,'1월 6일 첫구매 DM 코딩 수정요청');
INSERT INTO mp_work_data VALUES (573,1,'2011-01-07',2,1,1,1.5,'주문서작성 단계의 쿠폰 조회 및 적용 팝업');
INSERT INTO mp_work_data VALUES (574,1,'2011-01-07',2,1,1,1.5,'만다리나덕 구매왕 이벤트 코딩요청');
INSERT INTO mp_work_data VALUES (575,1,'2011-01-10',2,1,1,1.0,'재구매 고객 쿠폰증정 이벤트');
INSERT INTO mp_work_data VALUES (576,1,'2011-01-10',2,1,1,0.5,'1월 10일자 dm 수정요청');
INSERT INTO mp_work_data VALUES (577,1,'2011-01-10',2,1,1,6.0,'자동발송 메일 코딩 수정 요청');
INSERT INTO mp_work_data VALUES (578,1,'2011-01-11',2,1,1,0.5,'1월 12일 정기 DM 코딩 수정요청');
INSERT INTO mp_work_data VALUES (579,1,'2011-01-12',2,1,1,1.0,'이벤트네비영역 추가');
INSERT INTO mp_work_data VALUES (580,1,'2011-01-12',2,1,1,0.5,'1월 12일 재구매 수정');
INSERT INTO mp_work_data VALUES (581,1,'2011-01-12',2,1,1,1.5,'1월 12일 재구매 DM 코딩요청');
INSERT INTO mp_work_data VALUES (582,1,'2011-01-13',2,1,1,0.5,'시즌오프세일 페이지 네비 삭제요청');
INSERT INTO mp_work_data VALUES (583,1,'2011-01-13',2,1,1,0.5,'17일 정기dm 품절상품 교체');
INSERT INTO mp_work_data VALUES (584,1,'2011-01-13',2,1,1,1.0,'마이페이지 내에 임직원 여부 표시');
INSERT INTO mp_work_data VALUES (585,1,'2011-01-14',2,1,1,1.0,'만다리나덕 캐리어 밸트 증정 이벤트');
INSERT INTO mp_work_data VALUES (586,1,'2011-01-14',2,1,1,0.5,'신한카드 이벤트 페이지내 수정');
INSERT INTO mp_work_data VALUES (587,1,'2011-01-14',2,1,1,0.5,'이벤트 네비영역 수정');
INSERT INTO mp_work_data VALUES (588,1,'2011-01-06',6,1,1,1.0,'1월 1차 주말DM 코딩 요청안');
INSERT INTO mp_work_data VALUES (589,1,'2011-01-06',6,1,1,1.0,'구매유도사은행사DM');
INSERT INTO mp_work_data VALUES (590,1,'2011-01-11',6,1,1,2.0,'설날몰 수정');
INSERT INTO mp_work_data VALUES (591,1,'2011-01-12',6,1,1,1.5,'설날몰수정_대카테고리명수정및중카추가');
INSERT INTO mp_work_data VALUES (592,1,'2011-01-13',6,1,1,3.0,'슈퍼메인새해분위기아이콘삭제_가이드북삽입요청');
INSERT INTO mp_work_data VALUES (593,1,'2011-01-13',6,1,1,1.5,'설날몰10%쿠폰 알뜰쿠폰북수록코딩');
INSERT INTO mp_work_data VALUES (594,1,'2011-01-14',6,1,1,1.0,'사이트상단배너밀림현상 수정요청');
INSERT INTO mp_work_data VALUES (595,1,'2011-01-14',6,1,1,1.0,'디자인완료_설날몰메인수정요청');
INSERT INTO mp_work_data VALUES (596,1,'2011-01-14',6,1,1,1.5,'디자인완료_알뜰쿠폰북_헬로디씨쿠폰인증수록코딩요청');
INSERT INTO mp_work_data VALUES (597,1,'2011-01-10',4,1,1,1.0,'크리스마스트리 장식 모으기 이벤트 당첨자발표 코딩요청');
INSERT INTO mp_work_data VALUES (598,1,'2011-01-10',4,1,1,1.5,'1월 11일 발송 코엑스 정기DM 코딩 요청');
INSERT INTO mp_work_data VALUES (599,1,'2011-01-12',4,1,1,0.5,'DM 수정 요청드립니다.');
INSERT INTO mp_work_data VALUES (600,1,'2011-01-03',3,1,1,1.5,'1월 정기 DM_1월 5일 발송');
INSERT INTO mp_work_data VALUES (601,1,'2011-01-04',3,1,1,0.5,'1월 5일 정기 dm 수정요청');
INSERT INTO mp_work_data VALUES (602,1,'2011-01-06',3,1,1,1.5,'슈라멕 구매왕 코딩 요청(디자인자료 첨부)');
INSERT INTO mp_work_data VALUES (603,1,'2011-01-07',3,1,1,2.0,'메인_새해 컨셉 반영');
INSERT INTO mp_work_data VALUES (604,1,'2011-01-07',3,1,1,1.5,'메인_레이어 팝업 사이즈 수정');
INSERT INTO mp_work_data VALUES (605,1,'2011-01-04',10,1,1,3.0,'연하장보내기(696)');
INSERT INTO mp_work_data VALUES (606,1,'2011-01-04',10,1,1,3.0,'겨울스킨(2차) 변경 요청');
INSERT INTO mp_work_data VALUES (622,2,'2010-12-01',7,3,1,5.0,'메인 배너 작업(1주차)');
INSERT INTO mp_work_data VALUES (621,2,'2010-12-24',7,4,1,3.0,'메인 플래시 버튼 링크 및 이미지 교체');
INSERT INTO mp_work_data VALUES (620,2,'2010-12-17',7,4,1,4.0,'디지털 파크 메뉴 추가 작업');
INSERT INTO mp_work_data VALUES (619,2,'2010-12-10',7,4,1,8.0,'신규 지점 오픈 (총 3개 지점)');
INSERT INTO mp_work_data VALUES (618,2,'2010-12-10',7,4,1,3.0,'CI 교체건');
INSERT INTO mp_work_data VALUES (623,2,'2010-12-08',7,3,1,5.0,'메인 배너 작업(2주차)');
INSERT INTO mp_work_data VALUES (624,2,'2010-12-15',7,3,1,5.0,'메인 배너 작업(3주차)');
INSERT INTO mp_work_data VALUES (625,2,'2010-12-29',7,3,1,5.0,'메인 배너 작업(4주차)');
INSERT INTO mp_work_data VALUES (626,2,'2011-01-13',7,3,1,2.0,'마트 기획전 배너 플래시 수정');
INSERT INTO mp_work_data VALUES (627,2,'2010-12-02',5,4,1,5.0,'국영중문 인터넷점 링크URL변경');
INSERT INTO mp_work_data VALUES (628,2,'2010-12-06',5,4,1,6.0,'중문_이벤트메뉴추가');
INSERT INTO mp_work_data VALUES (629,2,'2010-12-22',5,4,1,3.0,'영중문 플래시 모션 및 액션 수정');
INSERT INTO mp_work_data VALUES (630,2,'2010-12-23',5,4,1,4.0,'영중문 로고 엠블렘 삭제');
INSERT INTO mp_work_data VALUES (631,2,'2010-12-23',5,4,1,3.0,'지점 매장 지도 전화번호 주소 수정');
INSERT INTO mp_work_data VALUES (632,2,'2010-12-29',5,4,1,6.0,'중문 전영역 메뉴 수정');
INSERT INTO mp_work_data VALUES (633,2,'2011-01-04',5,4,1,5.0,'중문 사이트 오타 수정');
INSERT INTO mp_work_data VALUES (634,2,'2010-12-06',5,3,1,5.0,'CM송페이지 플래시작업');
INSERT INTO mp_work_data VALUES (635,2,'2010-12-06',5,3,1,15.0,'겨울시즌 모델컷교체');
INSERT INTO mp_work_data VALUES (636,2,'2010-12-14',5,3,1,5.0,'영중문 메인 모델컷교체');
INSERT INTO mp_work_data VALUES (637,2,'2010-12-22',5,3,1,4.0,'영중문 플래시 모션 및 액션 수정');
INSERT INTO mp_work_data VALUES (638,2,'2010-12-01',1,4,1,3.0,'세일 메인 이벤트배너, 아이콘 수정 작업');
INSERT INTO mp_work_data VALUES (639,2,'2010-12-02',1,4,1,7.0,'Happy Christmas & Adieu 2010 Party 이벤트 플래시 작업');
INSERT INTO mp_work_data VALUES (640,2,'2010-12-06',1,4,1,5.0,'10조 돌파 세레모니 인트로 플래시 작업');
INSERT INTO mp_work_data VALUES (641,2,'2010-12-09',1,4,1,3.0,'10조 돌파 세레모니 인트로 매출액 변경');
INSERT INTO mp_work_data VALUES (642,2,'2010-12-10',1,4,1,2.0,'10조 돌파 세레모니 인트로 매출액 변경');
INSERT INTO mp_work_data VALUES (643,2,'2010-12-15',1,4,1,5.0,'문화홀 지점 공연 안내 비쥬얼 변경');
INSERT INTO mp_work_data VALUES (644,2,'2010-12-29',1,4,1,3.0,'천진점 이미지 및 텍스트 수정');
INSERT INTO mp_work_data VALUES (645,2,'2010-12-30',1,4,1,6.0,'백화점 관련 전 사이트 하단 영역 footer 수정');
INSERT INTO mp_work_data VALUES (646,2,'2011-01-03',1,4,1,5.0,'새로운 얼굴 동영상 플래이어 제작');
INSERT INTO mp_work_data VALUES (647,2,'2011-01-05',1,4,1,3.0,'웨딩 센터 영등포점 울산점 삭제');
INSERT INTO mp_work_data VALUES (648,2,'2011-01-05',1,4,1,5.0,'롯데 상품권 소개 페이지 동영상 플래시 제작');
INSERT INTO mp_work_data VALUES (649,2,'2011-01-06',1,4,1,7.0,'세일 메인 플래시 제작');
INSERT INTO mp_work_data VALUES (650,2,'2011-01-06',1,4,1,3.0,'천진점 메인 플래시 이미지 교체');
INSERT INTO mp_work_data VALUES (651,2,'2011-01-07',1,4,1,1.0,'세일 메인 하단 부분 이미지 수정');
INSERT INTO mp_work_data VALUES (652,2,'2011-01-07',1,4,1,1.0,'세일 메인 하단 부분 이미지 수정');
INSERT INTO mp_work_data VALUES (653,2,'2011-01-07',1,4,1,2.0,'세일 이벤트 타켓 부분 수정');
INSERT INTO mp_work_data VALUES (654,2,'2011-01-10',1,4,1,3.0,'영플라자 위드유 마일리지 삭제');
INSERT INTO mp_work_data VALUES (655,2,'2011-01-10',1,4,1,2.0,'세일 메인 테마 이벤트 배너 수정');
INSERT INTO mp_work_data VALUES (656,2,'2011-01-11',1,4,1,2.0,'세일 메인 테마 이벤트 배너 수정');
INSERT INTO mp_work_data VALUES (657,2,'2011-01-11',1,4,1,2.0,'천진점 홈페이지 메인 인재모집 배너 추가작업');
INSERT INTO mp_work_data VALUES (658,2,'2011-01-11',1,4,1,1.0,'세일 메인 이미지 수정');
INSERT INTO mp_work_data VALUES (659,2,'2011-01-12',1,4,1,1.0,'세일 메인 플래어 아이콘 추가 작업');
INSERT INTO mp_work_data VALUES (660,2,'2011-01-13',1,4,1,1.0,'세일 메인 이미지 수정');
INSERT INTO mp_work_data VALUES (661,2,'2011-01-17',1,4,1,1.0,'세일 메인 이미지 수정');
INSERT INTO mp_work_data VALUES (662,2,'2011-01-18',1,4,1,1.0,'세일 메인 이미지 수정');
INSERT INTO mp_work_data VALUES (663,2,'2011-01-18',1,4,1,3.0,'백화점 gnb 메뉴 삭제');
INSERT INTO mp_work_data VALUES (664,2,'2010-12-03',1,3,1,3.0,'천진점 홈페이지 메인 플래시 보완 작업');
INSERT INTO mp_work_data VALUES (665,2,'2010-12-06',1,3,1,15.0,'10조 돌파 세레모니 인트로 플래시 작업');
INSERT INTO mp_work_data VALUES (666,2,'2010-12-14',12,4,1,3.0,'gnb 메뉴 삭제');
INSERT INTO mp_work_data VALUES (667,2,'2010-12-22',12,4,1,3.0,'서브 페이지 lnb 메뉴 수정');
INSERT INTO mp_work_data VALUES (668,2,'2010-12-13',11,3,1,2.0,'[IR]  사업현황 수정');
INSERT INTO mp_work_data VALUES (669,2,'2010-12-06',2,4,1,4.0,'메인 겨울컨셉 반영');
INSERT INTO mp_work_data VALUES (670,2,'2010-12-09',2,4,1,5.0,'스폐셜오더가이드 수정');
INSERT INTO mp_work_data VALUES (671,2,'2010-12-23',2,4,1,2.0,'메인 겨울컨셉 수정');
INSERT INTO mp_work_data VALUES (672,2,'2010-12-31',2,4,1,3.0,'유틸바 이미지 수정');
INSERT INTO mp_work_data VALUES (673,2,'2011-01-12',2,4,1,4.0,'스페셜 오더 가이드 수정');
INSERT INTO mp_work_data VALUES (674,2,'2011-01-14',2,4,1,5.0,'유틸바 배너 제작');
INSERT INTO mp_work_data VALUES (675,2,'2011-01-17',2,4,1,15.0,'유틸바 최대 수량 개선 작업');
INSERT INTO mp_work_data VALUES (676,2,'2010-12-02',6,4,1,4.0,'사이트메인롤링배너지붕디자인변경');
INSERT INTO mp_work_data VALUES (677,2,'2010-12-07',6,4,1,7.0,'즉석복권이벤트');
INSERT INTO mp_work_data VALUES (678,2,'2010-12-08',6,4,1,3.0,'연말분위기_에러확인');
INSERT INTO mp_work_data VALUES (679,2,'2010-12-14',6,4,1,4.0,'즉선 복권 이벤트 영역 수정');
INSERT INTO mp_work_data VALUES (680,2,'2010-12-23',6,4,1,5.0,'메인 배너 새해 분위기 변경');
INSERT INTO mp_work_data VALUES (681,2,'2010-12-24',6,4,1,20.0,'2011년 선물 대전 사이트 제작 (1월 까지 포함)');
INSERT INTO mp_work_data VALUES (682,2,'2011-01-10',6,4,1,3.0,'새해몰 대카테고리 중카테고리 추가 작업');
INSERT INTO mp_work_data VALUES (683,2,'2011-01-13',6,4,1,2.0,'새해몰 이미지 수정');
INSERT INTO mp_work_data VALUES (684,2,'2010-12-31',4,4,1,3.0,'웨딩샵 링크 수정');
INSERT INTO mp_work_data VALUES (685,2,'2011-01-10',4,4,1,3.0,'메인 로고 수정');
INSERT INTO mp_work_data VALUES (686,2,'2010-12-07',3,4,1,4.0,'메인_겨울 컨셉 반영');
INSERT INTO mp_work_data VALUES (687,2,'2010-12-16',3,4,1,3.0,'이용가이드 & 스페셜오더 오타 수정');
INSERT INTO mp_work_data VALUES (688,2,'2010-12-21',3,4,1,10.0,'gnb 및 플래시 배너 재제작');
INSERT INTO mp_work_data VALUES (689,2,'2010-12-27',3,4,1,2.0,'메인 겨울 컨셥 삭제');
INSERT INTO mp_work_data VALUES (690,2,'2011-01-04',3,4,1,4.0,'서브 검색 페이지 메인 플래시 배너 삽입');
INSERT INTO mp_work_data VALUES (691,2,'2011-01-06',3,4,1,3.0,'메인 새해 컨셉 반영');
INSERT INTO mp_work_data VALUES (692,2,'2011-01-06',3,3,1,3.0,'메인 새해 컨셉 반영');
INSERT INTO mp_work_data VALUES (693,2,'2010-12-20',9,4,1,6.0,'신규 지점 오픈 (지점 2개)');
INSERT INTO mp_work_data VALUES (694,2,'2010-12-21',9,4,1,2.0,'지점 이미지 사진 수정 작업');
INSERT INTO mp_work_data VALUES (695,2,'2010-12-31',9,4,1,2.0,'하단 footer 연도 수정');
INSERT INTO mp_work_data VALUES (696,2,'2010-12-03',10,4,1,3.0,'나의스타일비법~ 롯데Only 이벤트');
INSERT INTO mp_work_data VALUES (697,2,'2010-12-06',10,4,1,2.0,'플래어 이벤트 추가 및 예약');
INSERT INTO mp_work_data VALUES (698,2,'2010-12-07',10,4,1,3.0,'플래어 이벤트 추가 및 예약');
INSERT INTO mp_work_data VALUES (699,2,'2011-01-03',10,4,1,3.0,'연하장 보내기 이벤트 제작');
INSERT INTO mp_work_data VALUES (700,2,'2011-01-03',10,4,1,2.0,'43호 오픈 시 이벤트 추가');
INSERT INTO mp_work_data VALUES (701,2,'2010-12-07',10,3,1,15.0,'플래어 42호 추가');
INSERT INTO mp_work_data VALUES (702,2,'2011-01-03',10,3,1,5.0,'연하장 보내기 이벤트 제작');
INSERT INTO mp_work_data VALUES (703,2,'2011-01-13',10,3,1,15.0,'44호 플래어 제작');
INSERT INTO mp_work_data VALUES (704,1,'2011-01-20',14,1,1,0.5,'광렙 메인페이지 수정');
INSERT INTO mp_work_data VALUES (705,1,'2011-01-12',14,1,1,1.5,'로그인 실패 페이지(광렙, 아지트) 코딩');
INSERT INTO mp_work_data VALUES (706,1,'2011-01-12',14,1,1,1.0,'회원가입페이지 수정, 하단 풋터 회사 주소 추가');
INSERT INTO mp_work_data VALUES (707,1,'2011-01-20',15,1,1,5.0,'아이피그룹 모바일 웹 메인페이지 코딩 및 테스트');
INSERT INTO mp_work_data VALUES (708,1,'2011-01-20',14,1,1,4.0,'우측 SS 배너 추가');
INSERT INTO mp_work_data VALUES (709,1,'2011-01-20',2,1,1,1.0,'마법을 걸다 이벤트 당첨자 발표');

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
) TYPE=MyISAM COMMENT='작업자정보 테이블';

--
-- Dumping data for table `mp_worker_info`
--

INSERT INTO mp_worker_info VALUES (1,1,1,'황철민');
INSERT INTO mp_worker_info VALUES (2,1,2,'이슬비');
INSERT INTO mp_worker_info VALUES (3,2,2,'조성구');
INSERT INTO mp_worker_info VALUES (4,2,3,'송원섭');
INSERT INTO mp_worker_info VALUES (5,2,1,'김우령');

