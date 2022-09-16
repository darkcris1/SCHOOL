import math

def identify(num: int):
    return '0' if num % 2 == 0 else '1'

def binary_to_decimal(num: int):
    if num < 2: return identify(num)
    divide = math.floor(num / 2)
    return binary_to_decimal(divide) + identify(num)