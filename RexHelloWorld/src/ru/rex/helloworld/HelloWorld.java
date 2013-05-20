package ru.rex.helloworld;

import java.awt.BorderLayout;
import java.awt.Toolkit;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.DefaultListModel;
import javax.swing.GroupLayout;
import javax.swing.GroupLayout.Alignment;
import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JList;
import javax.swing.JOptionPane;
import javax.swing.JPanel;
import javax.swing.JScrollPane;
import javax.swing.JTextField;
import javax.swing.LayoutStyle.ComponentPlacement;
import javax.swing.ListSelectionModel;
import javax.swing.event.ListSelectionEvent;
import javax.swing.event.ListSelectionListener;

import ru.rex.helloworld.internet.Domain;
import ru.rex.helloworld.internet.ShortNameException;

import com.jgoodies.forms.factories.FormFactory;
import com.jgoodies.forms.layout.ColumnSpec;
import com.jgoodies.forms.layout.FormLayout;
import com.jgoodies.forms.layout.RowSpec;

/**
 * Default project
 * 
 * @author rex
 */
public class HelloWorld extends JFrame {

	/**
	 * 
	 */
	private static final long serialVersionUID = 4966195341084811888L;

	private JTextField txtDomainName;
	private JTextField txtDomainOwner;
	private JTextField txtDomainEmail;
	private JTextField txtDomainTel;

	private DefaultListModel<Domain> domainsModel;
	@SuppressWarnings("rawtypes")
	private JList domainsList;
	private JFrame appFrame;
	private JButton btnDelete;
	private JButton btnUpdate;

	@SuppressWarnings({ "rawtypes", "unchecked" })
	public HelloWorld() {
		setResizable(false);
		setIconImage(Toolkit.getDefaultToolkit().getImage(HelloWorld.class.getResource("/ru/rex/helloworld/favicon.ico")));
		setTitle("\u0411\u0430\u0437\u0430 \u0434\u043E\u043C\u0435\u043D\u043E\u0432");
		appFrame = this;

		JPanel mainPanel = new JPanel();
		getContentPane().add(mainPanel, BorderLayout.CENTER);
		mainPanel.setLayout(new FormLayout(new ColumnSpec[] {
				ColumnSpec.decode("150dlu"),
				ColumnSpec.decode("max(159dlu;default):grow"),},
			new RowSpec[] {
				FormFactory.LINE_GAP_ROWSPEC,
				RowSpec.decode("353px:grow"),}));

		domainsModel = new DefaultListModel<Domain>();

		JButton btnAdd = new JButton("\u0414\u043E\u0431\u0430\u0432\u0438\u0442\u044C");
		btnAdd.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				try {
					Domain domain = new Domain(txtDomainName.getText(),
							txtDomainOwner.getText(),txtDomainEmail.getText(),
							txtDomainTel.getText());

					if (!domainsModel.contains(domain)) {
						domainsModel.addElement(domain);
					} else {
						JOptionPane.showMessageDialog(appFrame,
								"Уже есть.", "Hint",
								JOptionPane.WARNING_MESSAGE);
					}
				} catch (ShortNameException e) {
					JOptionPane.showMessageDialog(appFrame, e.getMessage(),
							"Ошибка валидации", JOptionPane.ERROR_MESSAGE);
				}

			}
		});
		
		JScrollPane scrollPane = new JScrollPane();
		mainPanel.add(scrollPane, "1, 2, fill, fill");
		domainsList = new JList(domainsModel);
		scrollPane.setViewportView(domainsList);
		domainsList.setLayoutOrientation(JList.VERTICAL_WRAP);
		domainsList.setSelectionMode(ListSelectionModel.SINGLE_SELECTION);
		domainsList.addListSelectionListener(new ListSelectionListener() {
			public void valueChanged(ListSelectionEvent e) {
				boolean isEnabled = domainsList.getSelectedIndex() >= 0;

				btnUpdate.setEnabled(isEnabled);
				btnDelete.setEnabled(isEnabled);

				if (isEnabled) {
					int currentIdx = domainsList.getSelectedIndex();
					Domain domain = domainsModel.elementAt(currentIdx);

					txtDomainName.setText(domain.getDomain());
					txtDomainEmail.setText(domain.getOwnerEmail());
					txtDomainOwner.setText(domain.getOwnerName());
					txtDomainTel.setText(domain.getOwnerPhone());
				}
			}
		});

		JPanel controlsPanel = new JPanel();
		mainPanel.add(controlsPanel, "2, 2, fill, fill");

		JButton btnNewButton = new JButton("\u0412\u044B\u0445\u043E\u0434");
		btnNewButton.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent arg0) {
				appFrame.setVisible(false);
				appFrame.dispose();
			}
		});

		btnDelete = new JButton("\u0423\u0434\u0430\u043B\u0438\u0442\u044C");
		btnDelete.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				int currentIdx = domainsList.getSelectedIndex();

				domainsModel.remove(currentIdx);

				txtDomainName.setText("");
				txtDomainEmail.setText("");
				txtDomainOwner.setText("");
				txtDomainTel.setText("");

				domainsList.repaint();

			}
		});
		
		btnUpdate = new JButton("\u041E\u0431\u043D\u043E\u0432\u0438\u0442\u044C");
		btnUpdate.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {

				int currentIdx = domainsList.getSelectedIndex();
				Domain domain = domainsModel.elementAt(currentIdx);

				try {
					domain.setDomain(txtDomainName.getText());
					domain.setOwnerEmail(txtDomainEmail.getText());
					domain.setOwnerName(txtDomainOwner.getText());
					domain.setOwnerPhone(txtDomainTel.getText());

					domainsModel.set(currentIdx, domain);
					domainsList.repaint();
				} catch (ShortNameException exc) {
					JOptionPane.showMessageDialog(appFrame, exc.getMessage(),
							"Ошибка", JOptionPane.ERROR_MESSAGE);
				}
			}
		});

		btnUpdate.setEnabled(false);
		btnDelete.setEnabled(false);

		txtDomainName = new JTextField();
		txtDomainName.setColumns(10);

		JLabel lblDomianName = new JLabel("\u0414\u043E\u043C\u0435\u043D");
		JLabel lblDomainOwner = new JLabel("\u0412\u043B\u0430\u0434\u0435\u043B\u0435\u0446 \u0434\u043E\u043C\u0435\u043D\u0430");

		txtDomainOwner = new JTextField();
		txtDomainOwner.setColumns(10);

		JLabel lblOwnerEmail = new JLabel("Email \u0432\u043B\u0430\u0434\u0435\u043B\u044C\u0446\u0430 \u0434\u043E\u043C\u0435\u043D\u0430");

		txtDomainEmail = new JTextField();
		txtDomainEmail.setColumns(10);

		JLabel lblOwnerTel = new JLabel("\u0422\u0435\u043B\u0435\u0444\u043E\u043D \u0432\u043B\u0430\u0434\u0435\u043B\u044C\u0446\u0430 \u0434\u043E\u043C\u0435\u043D\u0430");

		txtDomainTel = new JTextField();
		txtDomainTel.setColumns(10);

		GroupLayout gl_controlsPanel = new GroupLayout(controlsPanel);
		gl_controlsPanel.setHorizontalGroup(
			gl_controlsPanel.createParallelGroup(Alignment.TRAILING)
				.addGroup(gl_controlsPanel.createSequentialGroup()
					.addContainerGap()
					.addGroup(gl_controlsPanel.createParallelGroup(Alignment.LEADING)
						.addComponent(btnNewButton, Alignment.TRAILING)
						.addComponent(txtDomainName, Alignment.TRAILING, GroupLayout.DEFAULT_SIZE, 315, Short.MAX_VALUE)
						.addComponent(txtDomainOwner, Alignment.TRAILING, GroupLayout.DEFAULT_SIZE, 315, Short.MAX_VALUE)
						.addComponent(txtDomainEmail, Alignment.TRAILING, GroupLayout.DEFAULT_SIZE, 315, Short.MAX_VALUE)
						.addComponent(txtDomainTel, Alignment.TRAILING, GroupLayout.DEFAULT_SIZE, 315, Short.MAX_VALUE)
						.addGroup(Alignment.TRAILING, gl_controlsPanel.createSequentialGroup()
							.addComponent(btnDelete)
							.addPreferredGap(ComponentPlacement.RELATED)
							.addComponent(btnUpdate)
							.addPreferredGap(ComponentPlacement.RELATED)
							.addComponent(btnAdd))
						.addComponent(lblOwnerEmail, GroupLayout.PREFERRED_SIZE, 193, GroupLayout.PREFERRED_SIZE)
						.addComponent(lblDomianName, GroupLayout.PREFERRED_SIZE, 150, GroupLayout.PREFERRED_SIZE)
						.addComponent(lblDomainOwner, GroupLayout.PREFERRED_SIZE, 145, GroupLayout.PREFERRED_SIZE)
						.addComponent(lblOwnerTel, GroupLayout.PREFERRED_SIZE, 177, GroupLayout.PREFERRED_SIZE))
					.addContainerGap())
		);
		gl_controlsPanel.setVerticalGroup(
			gl_controlsPanel.createParallelGroup(Alignment.TRAILING)
				.addGroup(gl_controlsPanel.createSequentialGroup()
					.addComponent(lblDomianName)
					.addPreferredGap(ComponentPlacement.RELATED)
					.addComponent(txtDomainName, GroupLayout.PREFERRED_SIZE, GroupLayout.DEFAULT_SIZE, GroupLayout.PREFERRED_SIZE)
					.addPreferredGap(ComponentPlacement.RELATED)
					.addComponent(lblDomainOwner)
					.addPreferredGap(ComponentPlacement.RELATED)
					.addComponent(txtDomainOwner, GroupLayout.PREFERRED_SIZE, GroupLayout.DEFAULT_SIZE, GroupLayout.PREFERRED_SIZE)
					.addPreferredGap(ComponentPlacement.RELATED)
					.addComponent(lblOwnerEmail)
					.addPreferredGap(ComponentPlacement.RELATED)
					.addComponent(txtDomainEmail, GroupLayout.PREFERRED_SIZE, GroupLayout.DEFAULT_SIZE, GroupLayout.PREFERRED_SIZE)
					.addPreferredGap(ComponentPlacement.RELATED)
					.addComponent(lblOwnerTel)
					.addPreferredGap(ComponentPlacement.RELATED)
					.addComponent(txtDomainTel, GroupLayout.PREFERRED_SIZE, GroupLayout.DEFAULT_SIZE, GroupLayout.PREFERRED_SIZE)
					.addPreferredGap(ComponentPlacement.RELATED)
					.addGroup(gl_controlsPanel.createParallelGroup(Alignment.BASELINE)
						.addComponent(btnAdd)
						.addComponent(btnUpdate)
						.addComponent(btnDelete))
					.addPreferredGap(ComponentPlacement.RELATED, 159, Short.MAX_VALUE)
					.addComponent(btnNewButton)
					.addContainerGap())
		);
		controlsPanel.setLayout(gl_controlsPanel);
	}

	/**
	 * Entry point
	 * 
	 * @param args
	 *
	 */
	public static void main(String[] args) {
		javax.swing.SwingUtilities.invokeLater(new Runnable() {
            @Override
            public void run() {
                HelloWorld hw = new HelloWorld();
                hw.setBounds(100, 100, 800, 600);
                hw.setVisible(true);
            }
        });

	}
}
