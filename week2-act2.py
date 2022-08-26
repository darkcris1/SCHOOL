
# Week 2 act 2 = O(n²)
array = [1,3,4,5,2,1]
enumerate_array = enumerate(array)

for index, item in enumerate_array:
    has_duplicate = False
    for index2, item2 in enumerate_array:
        if index2 == index:
            continue

        if item2 == item:
            has_duplicate = True

    if has_duplicate:
        print(True)
        break
    else:
        print(False)