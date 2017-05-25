import random
import math

def xgcd(b, n): #computes the gcd(b,n) using the extended euclidian algoritm
    x0, x1, y0, y1 = 1, 0, 0, 1
    while n != 0:
        q, b, n = b // n, n, b % n
        x0, x1 = x1, x0 - q * x1
        y0, y1 = y1, y0 - q * y1
    return  b, x0, y0

def mulinv(b, n): #computes the multiplicative inverse of a number mod n
    g, x, _ = xgcd(b, n)
    if g == 1:
        return x % n

def is_prime(n):
    if n <= 1: #anything less than or equal to one is not prime
        return False
    elif n <= 3: #anything less than or equal to 3 but greater than 1 is prime (looks nicer than == 2 or == 3)
        return True
    elif n % 2 == 0 or n % 3 == 0: #check if it is divisible by 2 or 3
        return False
    i = 5
    while i * i <= n: #sets the maximum range of the prime number check, a number n is factored into primes a and b, one factor has to <= sqrt(n), so the smaller factor squared should at maximum equal n
        if n % i == 0 or n % (i + 2) == 0: #goes through a list of possible primes (all primes are of the form 6n+-1) and checks if they are factors
            return False                  
        i = i + 6 #increments n by 6 so that it can test the next possible prime
    return True

def gen_primes(lower,upper): #generates two random primes in a range from lower to upper
    candidate1 = random.randint(lower,upper)
    candidate2 = random.randint(lower,upper)
    #if it is not prime, regenerate it until it is
    while not is_prime(candidate1) or not is_prime(candidate2) or candidate1 == candidate2:
        if not is_prime(candidate1):
            candidate1 = random.randint(lower,upper)
        elif not is_prime(candidate2):
            candidate2 = random.randint(lower,upper)
        elif (not is_prime(candidate1) and not is_prime(candidate2)) or candidate1 == candidate2:
            candidate1 = random.randint(lower,upper)
            candidate2 = random.randint(lower,upper)
    return candidate1, candidate2

def is_coprime(p,q):
    return p%q != 0 and q%p != 0

def totient(p,q): #computes the totient of the product of the two prime inputs, the totient is the number of numbers coprime to that product
    assert is_prime(p) and is_prime(q), "inputs must be prime"
    return (p-1)*(q-1)

def gen_keys(p,q,e): #generates public and private keypairs
    tot = totient(p,q)
    n = p*q

    assert e > 1 and e < tot, "public key is not within correct domain"
    assert math.gcd(e,tot) == 1, "e is not correctly chosen"
    assert is_coprime(e,tot), "public key and totient are not coprime"

    d = mulinv(e,tot)
    return (e,n),(d,n)

#message input must be number (convert text to ascii numbers)
#public key input is a tuple of (public exponent, n)
def encrypt(public_key,message):
    if type(message) == str:
        ciphertext = []
        for char in message:
            assert ord(char) > 1 and ord(char) < public_key[1],"seed is too small"
            ciphertext.append(pow(ord(char),public_key[0],public_key[1]))
    else:
        assert message > 1 and message < public_key[1],"seed is too small"
        ciphertext = pow(message,public_key[0],public_key[1])

    return ciphertext

#same format as encrypt
def decrypt(private_key,ciphertext):
    if type(ciphertext) == list:
        plaintext = []
        for char in ciphertext:
            plaintext.append(chr(pow(char,private_key[0],private_key[1])))
        plaintext = "".join(plaintext)
    else:
        plaintext = pow(ciphertext,private_key[0],private_key[1])

    return plaintext

#some brief tests to make sure it is working
t1,t2 = gen_primes(1,100)
assert is_prime(13),"is_prime did't correctly check if it was a prime"
assert is_prime(t1) and is_prime(t2),"gen_primes didn't generate a pair of primes"
assert totient(11,13) == 120, "totient is broken somehow"
assert is_coprime(12,13), "is_coprime does not correctly check for coprimes"

message = "abcdefghijklmnopqrstuvwxyz"
public = (7,2534665157)
private = (1810402843,2534665157)
print(public)
print(private)

print(message)
cipher = encrypt(public,message)
print(cipher)
plain = decrypt(private,cipher)
print(plain)
