
# Week 2 act 2 = O(n²)

def check_duplicate(array: list):
    """Check if there is duplicate in array"""
    enumerate_array = enumerate(array)

    for index, item in enumerate_array:
        for index2, item2 in enumerate_array:
            if index2 == index:
                continue

            if item2 == item:
                return True

    return False


array = [1,3,4,5,2,1]
print(check_duplicate(array))