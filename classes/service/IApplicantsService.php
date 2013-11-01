<?php
/**
 * User: IApplicantsService (toriworks@gmail.com)
 * Date: 13. 11. 1
 * Time: 오후 6:51
 */

interface IApplicantsService {
    public function add( $conn, Applicants $obj );
    public function update( $conn, Applicants $obj );
    public function update_keeper( $conn, Applicants $obj );
    public function delete( $conn, Applicants $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );

    public function detail($conn, Applicants $obj);
}