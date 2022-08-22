
# Assignment 2
for i in range(1,51):
    is_buzz = (i % 5) == 0
    is_fizz = (i % 3) == 0
    if is_fizz and is_buzz:
        print('fizzbuzz')
    elif is_fizz:
        print('fizz')
    elif is_buzz:
        print('buzz')
    else:
        print(i)