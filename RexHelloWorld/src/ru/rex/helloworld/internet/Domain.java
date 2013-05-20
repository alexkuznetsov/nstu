package ru.rex.helloworld.internet;

/**
 * @author rex
 *
 */
public class Domain {
	
	private String domainName;
	private String ownerName;
	private String ownerEmail;
	private String ownerPhone;
	
	public Domain(String name, String owner, String email, String phone) throws ShortNameException{
		setDomain(name);
		setOwnerName(owner);
		setOwnerEmail(email);
		setOwnerPhone(phone);
	}
	
	public String getOwnerEmail() {
		return ownerEmail;
	}

	public void setOwnerEmail(String ownerEmail) throws ShortNameException {
		if (ownerEmail.length() <= 4) {
			throw new ShortNameException("Email слишком короткий");
		}
		
		this.ownerEmail = ownerEmail;
	}

	public String getOwnerPhone() {
		return ownerPhone;
	}

	public void setOwnerPhone(String ownerPhone) throws ShortNameException {
		if (ownerPhone.length() <= 4) {
			throw new ShortNameException("Телефон владельца слишком короткий");
		}
		
		this.ownerPhone = ownerPhone;
	}

	public String getDomain() {
		return domainName;
	}

	public void setDomain(String domain) throws ShortNameException {
		if (domain.length() <=3) {
			throw new ShortNameException("Имя домена слишком короткое");
		}
		
		this.domainName = domain;
	}

	public String getOwnerName() {
		return ownerName;
	}
	
	public void setOwnerName(String ownerName) throws ShortNameException {
		if (ownerName.length() <= 4) {
			throw new ShortNameException("Имя владельца слишком короткое");
		}
		
		this.ownerName = ownerName;
	}
	
	@Override
	public String toString() {
		
		return domainName + ", " + ownerName + " <" + ownerEmail + '>';
	}
	
	@Override
	public boolean equals(Object obj) {
		if (!(obj instanceof Domain)) {
			return false;
		}
		
		Domain other = (Domain) obj;
		
		return  (getDomain().equalsIgnoreCase(other.getDomain()) &&
				getOwnerEmail().equalsIgnoreCase(other.getOwnerEmail()) &&
				getOwnerName().equalsIgnoreCase(other.getOwnerName()) &&
				getOwnerPhone().equalsIgnoreCase(other.getOwnerPhone()));
	}
	
	
}
