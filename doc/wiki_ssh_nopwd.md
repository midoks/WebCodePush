### SSH���½����

�л���A(192.168.1.155)��B(192.168.1.181)������Aͨ��ssh�������¼��B��

### ��A�������ɹ�Կ/˽Կ�ԡ�
ssh-keygen -t rsa
ssh-keygen -t rsa -P '����'

### ����B��

### ��B��.ssh/
cat id_rsa.pub >> authorized_keys
chmod 600 authorized_keys


### OK