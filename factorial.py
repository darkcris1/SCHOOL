def factorial(x):
    return (x * factorial(x-1)) if  x != 1 else 1

number = int(input('Enter a number: '))


print(factorial(number))