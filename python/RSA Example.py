#requires python 3
from RSA import * #so I don't have to always type "RSA."

message = "abcdefghijklmnopqrstuvwxyz"

q,p = gen_primes(10**9,10**10)

print(q)
print(p)
print(totient(q,p))
e = 7 #because why not

public,private = gen_keys(p,q,e)

print(public)
print(private)

print(message)
cipher = encrypt(public,message)
print(cipher)
plain = decrypt(private,cipher)
print(plain)
