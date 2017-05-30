import random
import math
import time

def rabinMiller(n,t,kn):
  assert t >= 1 and 0 <= kn <= 1
  if n<=3:
    if n>1:
      return True
    return False
  elif n%2==0:
    return False
  RANDOM=random.SystemRandom()
  r=n1=n-1
  s=0
  while (r%2)>0:
    s+=1
    r//=2
  s1=s-1
  for i in range(t):
    if i==0 and kn==1:
      a=2
    else:
      a=RANDOM.randint(2,n-2)    
    y=pow(a,r,n)
    if y!=1 and y!=n1:
      j=1
      while j<=s1 and y!=n1:
        y=(y*y)%n
        if y==1:
          return False      
        j+=1
      if y!=n1:
        return False
  return True

def xgcd(b, n): #computes the gcd(b,n) using the extended euclidian algoritm
    x0, x1, y0, y1 = 1, 0, 0, 1 #x0 and y0 are the last values of x and y, x1 and y1 are the current values of x and y
    while n != 0: #after going through the loop, n is the remainder of b/n
        q, b, n = b // n, n, b % n #q equals the integer part of b/n, b is set equal to n, and n is equal to b%n
        x0, x1 = x1, x0 - q * x1 #store the current x val in x0, then set the current x val to the last x value minus q times the current x val
        y0, y1 = y1, y0 - q * y1 #same thing as above, but for y; Start next loop with n as the new b and the remainder of b/n as the new n
    return  b, x0, y0 #return coefficents of bx + ny = gcd(b,n) and returns gcd(b, n)

def mulinv(b, n): #computes the multiplicative inverse of a number mod n
    g, x, _ = xgcd(b, n)
    if g == 1:
        return x % n

def gen_primes(lower,upper): #generates two random primes in a range from lower to upper
    candidate1 = random.randint(lower,upper)
    candidate2 = random.randint(lower,upper)
    #if it is not prime, regenerate it until it is
    while not rabinMiller(candidate1,5,0) or not rabinMiller(candidate2,5,0) or candidate1 == candidate2:        
        if not rabinMiller(candidate1,5,0) or candidate1 == candidate2:
            candidate1 = random.randint(lower,upper)
        elif not rabinMiller(candidate2,5,0) or candidate1 == candidate2:
            candidate2 = random.randint(lower,upper)
    return candidate1, candidate2

def gen_rsa_primes(lower,upper,e):
  p,q = gen_primes(lower,upper)
  while not is_coprime(e,totient(p,q)):
    p,q = gen_primes(lower,upper)
  return p,q

def is_coprime(p,q):
    return p%q != 0 and q%p != 0

def totient(p,q): #computes the totient of the product of the two prime inputs, the totient is the number of numbers coprime to that product
    assert rabinMiller(p,5,0) and rabinMiller(q,5,0), "inputs must be prime"
    return (p-1)*(q-1)

def gen_keys(p,q,e): #generates public and private keypairs
    tot = totient(p,q)
    n = p*q

    assert e > 1 and e < tot, "public key is not within correct domain"
    assert is_coprime(e,tot), "public key and totient are not coprime"

    d = mulinv(e,tot)
    return (e,n),(d,n)

#message input must be number (convert text to ascii numbers)
#public key input is a tuple of (public exponent, n)
def encrypt(public_key,message):
    if type(message) == str:
        ciphertext = []
        for char in message:
            ciphertext.append(encrypt(public_key,ord(char)))
    else:
        assert message > 1 and message < public_key[1],"seed is too small"
        ciphertext = pow(message,public_key[0],public_key[1])

    return ciphertext

#same format as encrypt
def decrypt(private_key,ciphertext):
    if type(ciphertext) == list:
        plaintext = []
        for char in ciphertext:
            plaintext.append(chr(decrypt(private_key,char)))
        plaintext = "".join(plaintext)
    else:
        plaintext = pow(ciphertext,private_key[0],private_key[1])

    return plaintext

#some brief tests to make sure it is working
t1,t2 = gen_rsa_primes(1,100,3)
assert rabinMiller(13,5,0),"is_prime did't correctly check if it was a prime"
assert rabinMiller(t1,5,0) and rabinMiller(t2,5,0), "gen_rsa_primes didn't generate a pair of primes"
assert is_coprime(totient(t1,t2),3), "gen_rsa_primes did not generate coprime primes"
assert totient(11,13) == 120, "totient is broken somehow"
assert is_coprime(12,13), "is_coprime does not correctly check for coprimes"

message = "abcdefghijklmnopqrstuvwxyz"
#message = 123
e = 2
start = time.clock()
p,q = gen_rsa_primes(pow(2,1024),pow(2,1025),e)
finish = time.clock() - start
public,private = gen_keys(p,q,e)
#public = (7,2534665157)
#private = (1810402843,2534665157)

#p,q = gen_rsa_primes(10000,15000,e)
#public,private = gen_keys(p,q,e)

print(public)
print(private)

print(message)
cipher = encrypt(public,message)
print(cipher)
plain = decrypt(private,cipher)
print(plain)
print(finish)
