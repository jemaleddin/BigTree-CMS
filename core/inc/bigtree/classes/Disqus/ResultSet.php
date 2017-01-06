<?php
	/*
		Class: BigTree\Disqus\ResultSet
			An object that contains multiple results from a Disqus API query.
	*/
	
	namespace BigTree\Disqus;
	
	use stdClass;
	
	class ResultSet {
		
		protected $Cursor;
		protected $LastCall;
		protected $LastParameters;
		protected $Object;
		
		public $Results;
		
		/*
			Constructor:
				Creates a result set of Disqus data.

			Parameters:
				object - An instance of an object that is creating this result set.
				last_call - Method called on the object.
				params - The parameters sent to last call.
				cursor - Disqus cursor data.
				results - Results to store.
		*/
		
		function __construct(&$object, string $last_call, array $params, stdClass $cursor, array $results) {
			$this->Cursor = $cursor;
			$this->LastCall = $last_call;
			$this->LastParameters = $params;
			$this->Object = $object;
			$this->Results = $results;
		}
		
		/*
			Function: nextPage
				Returns the next page in the result set.

			Returns:
				A BigTree\Disqus\ResultSet with the next page of results or false if there isn't another page.
		*/
		
		function nextPage(): ?ResultSet {
			if (!$this->Cursor->Next) {
				return null;
			}
			
			$params = $this->LastParameters;
			$params[count($params) - 1]["cursor"] = $this->Cursor->Next;
			
			return call_user_func_array([$this->Object, $this->LastCall], $params);
		}
		
		/*
			Function: previousPage
				Returns the previous page in the result set.

			Returns:
				A BigTree\Disqus\ResultSet with the next page of results or false if there isn't a previous page.
		*/
		
		function previousPage(): ?ResultSet {
			if (!$this->Cursor->Previous) {
				return null;
			}
			
			$params = $this->LastParameters;
			$params[count($params) - 1]["cursor"] = $this->Cursor->Previous;
			
			return call_user_func_array([$this->Object, $this->LastCall], $params);
		}
		
	}