<?php
/**
 * Class that operate on table 'loans'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-04-28 18:19
 */
class LoansMySqlDAO implements LoansDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return LoansMySql 
	 */
	public function load($userId, $friendId, $bookId, $loanDate){
		$sql = 'SELECT * FROM loans WHERE user_id = ?  AND friend_id = ?  AND book_id = ?  AND loan_date = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userId);
		$sqlQuery->setNumber($friendId);
		$sqlQuery->setNumber($bookId);
		$sqlQuery->setNumber($loanDate);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM loans';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM loans ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param loan primary key
 	 */
	public function delete($userId, $friendId, $bookId, $loanDate){
		$sql = 'DELETE FROM loans WHERE user_id = ?  AND friend_id = ?  AND book_id = ?  AND loan_date = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userId);
		$sqlQuery->setNumber($friendId);
		$sqlQuery->setNumber($bookId);
		$sqlQuery->setNumber($loanDate);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param LoansMySql loan
 	 */
	public function insert($loan){
		$sql = 'INSERT INTO loans (due_date, request_date, user_id, friend_id, book_id, loan_date) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($loan->dueDate);
		$sqlQuery->set($loan->requestDate);

		
		$sqlQuery->setNumber($loan->userId);

		$sqlQuery->setNumber($loan->friendId);

		$sqlQuery->setNumber($loan->bookId);

		$sqlQuery->setNumber($loan->loanDate);

		$this->executeInsert($sqlQuery);	
		//$loan->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param LoansMySql loan
 	 */
	public function update($loan){
		$sql = 'UPDATE loans SET due_date = ?, request_date = ? WHERE user_id = ?  AND friend_id = ?  AND book_id = ?  AND loan_date = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($loan->dueDate);
		$sqlQuery->set($loan->requestDate);

		
		$sqlQuery->setNumber($loan->userId);

		$sqlQuery->setNumber($loan->friendId);

		$sqlQuery->setNumber($loan->bookId);

		$sqlQuery->setNumber($loan->loanDate);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM loans';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDueDate($value){
		$sql = 'SELECT * FROM loans WHERE due_date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByRequestDate($value){
		$sql = 'SELECT * FROM loans WHERE request_date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDueDate($value){
		$sql = 'DELETE FROM loans WHERE due_date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByRequestDate($value){
		$sql = 'DELETE FROM loans WHERE request_date = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return LoansMySql 
	 */
	protected function readRow($row){
		$loan = new Loan();
		
		$loan->userId = $row['user_id'];
		$loan->friendId = $row['friend_id'];
		$loan->bookId = $row['book_id'];
		$loan->loanDate = $row['loan_date'];
		$loan->dueDate = $row['due_date'];
		$loan->requestDate = $row['request_date'];

		return $loan;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return LoansMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>