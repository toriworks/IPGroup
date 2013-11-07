<?php
/**
 * Created by IntelliJ IDEA.
 * User: csmaster
 * Date: 13. 11. 7
 * Time: 오후 9:45
 * To change this template use File | Settings | File Templates.
 */

interface IApplicantsCompanyService {
    public function add( $conn, ApplicantsCompany $obj );
    public function update( $conn, ApplicantsCompany $obj );
    public function delete( $conn, ApplicantsCompany $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );
}