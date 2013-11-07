<?php
/**
 * User: IApplicantsCompanyDao (toriworks@gmail.com)
 * Date: 13. 11. 1
 * Time: 오후 5:29
 */

interface IApplicantsCompanyDao {
    public function add( $conn, ApplicantsCompany $obj );
    public function update( $conn, ApplicantsCompany $obj );
    public function delete( $conn, ApplicantsCompany $obj );
    public function lists( $conn, $wParam, $orderBy, $curPage, $pageMax );
    public function listsCount( $conn, $wParam );
}
?>