<?php



	/**
	 * PHP Java-style definition of an Exception object-
	 */
	class cmsware_Exception {

		var $_exceptionString;
		var $_exceptionCode;

        /**
         * Creates a new exception.
         *
         * @param exceptionString Descriptive message carried by the exception
         * @param exceptionCode Numerical error code assigned to this exception
         */
		function cmsware_Exception( $exceptionString, $exceptionCode = 0 )
		{

			$this->_exceptionString = $exceptionString;
			$this->_exceptionCode   = $exceptionCode;

		}

		/**
		 * Throws the exception and stops the execution, dumping some
		 * interesting information.
		 */
		function cmsware_throw()
		{
			// gather some information
			switch(Error_Display) {
				case 'js':
					print "<script>alert(\"";
					print( "\\nException message: ".$this->_exceptionString."\\nError code: ".$this->_exceptionCode."\\n" );
					break;
				case 'html':
					print( "<br/><b>Exception message</b>: ".$this->_exceptionString."<br/><b>Error code</b>: ".$this->_exceptionCode."<br/>" );
					break;
				case 'text':
					break;
				case '':
					break;
			}
			$this->_printStackTrace();
		}

		function _printStackTrace()
		{
 			switch(Error_Display) {
				case 'js':
					if( function_exists("debug_backtrace")) {
						$info = debug_backtrace();


						print( "-- Backtrace --\\n" );
						foreach( $info as $trace ) {
							if( ($trace["function"] != "_internalerrorhandler") && ($trace["file"] != __FILE__ )) {
								print( addslashes($trace["file"]) );
								print( "(".$trace["line"]."): " );
								if( $trace["class"] != "" )
									print( $trace["class"]."." );
								print( $trace["function"] );
								print( "\\n" );
							}
						}
						//print( "</i>" );
					}
					else {
						print("Stack trace is not available\\n");
					}
					print("\");</script>");
					break;
				case 'html':
					if( function_exists("debug_backtrace")) {
						$info = debug_backtrace();


						print( "-- Backtrace --<br/><i>" );
						foreach( $info as $trace ) {
							if( ($trace["function"] != "_internalerrorhandler") && ($trace["file"] != __FILE__ )) {
								print( $trace["file"] );
								print( "(".$trace["line"]."): " );
								if( $trace["class"] != "" )
									print( $trace["class"]."." );
								print( $trace["function"] );
								print( "<br/>" );
							}
						}
						print( "</i>" );
					}
					else {
						print("<i>Stack trace is not available</i><br/>");
					}
					break;
				case 'text':

					break;
			
			}
			

		}
	}

	/**
	 * This error handler takes care of throwing exceptions whenever an error
	 * occurs.
	 */
	function _internalErrorHandler( $errorCode, $errorString )
	{
		$exc = new cmsware_Exception( $errorString, $errorCode );
		//print(var_dump(debug_backtrace()));

		// we don't want the E_NOTICE errors to throw an exception...
		if( $errorCode != E_NOTICE &&  $errorCode != 2048)
			$exc->cmsware_throw();
	}

    /**
     * Throws an exception
     */
	function cmsware_throw( $exception )
	{
		$exception->cmsware_throw();
	}

	function cmsware_catch( $exception )
	{
		print( "Exception catched!" );
	}

	// this registers our own error handler
	$old_error_handler = set_error_handler( "_internalErrorHandler" );
	// and now we say what we would like to see
?>
