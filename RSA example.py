from RSA import * #I do this so I don't have to do RSA. all the time

#example usage
public_key, private_key = gen_keys(3,11,7)
ciphertext = encrypt(public_key,2)
print(ciphertext)
plaintext = decrypt(private_key,ciphertext)
print(plaintext)
