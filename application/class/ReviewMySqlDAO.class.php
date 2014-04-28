<?php
/**
 * Class that operate on table 'review'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2014-04-28 18:19
 */
class ReviewMySqlDAO implements ReviewDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ReviewMySql 
	 */
	public function load($userId, $bookId){
		$sql = 'SELECT * FROM review WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userId);
		$sqlQuery->setNumber($bookId);

		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM review';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM review ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param review primary key
 	 */
	public function delete($userId, $bookId){
		$sql = 'DELETE FROM review WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($userId);
		$sqlQuery->setNumber($bookId);

		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ReviewMySql review
 	 */
	public function insert($review){
		$sql = 'INSERT INTO review (rating, review_text, user_id, book_id) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($review->rating);
		$sqlQuery->set($review->reviewText);

		
		$sqlQuery->setNumber($review->userId);

		$sqlQuery->setNumber($review->bookId);

		$this->executeInsert($sqlQuery);	
		//$review->id = $id;
		//return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ReviewMySql review
 	 */
	public function update($review){
		$sql = 'UPDATE review SET rating = ?, review_text = ? WHERE user_id = ?  AND book_id = ? ';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($review->rating);
		$sqlQuery->set($review->reviewText);

		
		$sqlQuery->setNumber($review->userId);

		$sqlQuery->setNumber($review->bookId);

		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM review';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByRating($value){
		$sql = 'SELECT * FROM review WHERE rating = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByReviewText($value){
		$sql = 'SELECT * FROM review WHERE review_text = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByRating($value){
		$sql = 'DELETE FROM review WHERE rating = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByReviewText($value){
		$sql = 'DELETE FROM review WHERE review_text = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ReviewMySql 
	 */
	protected function readRow($row){
		$review = new Review();
		
		$review->userId = $row['user_id'];
		$review->bookId = $row['book_id'];
		$review->rating = $row['rating'];
		$review->reviewText = $row['review_text'];

		return $review;
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
	 * @return ReviewMySql 
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