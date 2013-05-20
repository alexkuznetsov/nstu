package ru.rex.helloworld.internet;

public class ShortNameException extends Exception {

	/**
	 * 
	 */
	private static final long serialVersionUID = -7813442126997118453L;
	private String message;
	
	public ShortNameException(String message) {
		this.message = message;
	}
	
	@Override
	public String getMessage() {
		return message;
	}

}
