import pygame

pygame.init()
pygame.font.init()

SCREEN_WIDTH = 800
SCREEN_HEIGHT = 600

BLACK = (0, 0, 0)
WHITE = (255, 255, 255)
RED = (255, 0, 0)

font = pygame.font.SysFont('Comic Sans MS', 24)
screen = pygame.display.set_mode((SCREEN_WIDTH, SCREEN_HEIGHT))
pygame.display.set_caption("Fandiño")

space_bar_text = font.render('Press Space', True, (0,0,255) )
second_page_text = font.render('2nd Page', True, (0,0,255) )

# create a rectangular object for the
# text surface object
space_rect = space_bar_text.get_rect()
second_page_rect = second_page_text.get_rect()
 
# set the center of the rectangular object.
space_rect.center = (SCREEN_WIDTH // 2, SCREEN_HEIGHT // 2)
second_page_rect.center = (SCREEN_WIDTH // 2, SCREEN_HEIGHT // 2)


box = pygame.Rect((0, 0, 60, 60))
box2 = pygame.Rect((200, 200, 60, 60))

def second_page():
    screen.fill(RED)
    screen.blit(second_page_text, second_page_rect)

def first_page():
    screen.fill(BLACK)
    screen.blit(space_bar_text, space_rect)

def is_colliding(rect):
    """Check if rect is colliding with window edges"""
    return rect.left < 0 or rect.right > SCREEN_WIDTH or rect.top < 0 or rect.bottom > SCREEN_HEIGHT


def collide_and_push(rect, other_rect):
    """Check if rect is colliding with other_rect and push rect"""
    if rect.colliderect(other_rect):
        if (rect.bottom - 1) == other_rect.top:
            other_rect.move_ip(0, 1)
        elif (rect.top + 1) == other_rect.bottom:
            other_rect.move_ip(0, -1)
        elif (rect.left + 1) == other_rect.right:
            other_rect.move_ip(-1, 0)
        elif (rect.right - 1) == other_rect.left:
            other_rect.move_ip(1, 0)


page = 1
run = True
while run:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            run = False
            pygame.quit()

    key = pygame.key.get_pressed()

    pygame.time.delay(2)

    if key[pygame.K_UP] == True:
        box.move_ip(0, -1)
    elif key[pygame.K_DOWN] == True:
        box.move_ip(0, 1)
    elif key[pygame.K_LEFT] == True:
        box.move_ip(-1, 0)
    elif key[pygame.K_RIGHT] == True:
        box.move_ip(1, 0)

    # if is_colliding(box):
    #     box.clamp_ip(screen.get_rect())
    # if is_colliding(box2):
    #     box2.clamp_ip(screen.get_rect())
    if box.colliderect(box2):
        print('ping')
        box.clamp_ip(screen.get_rect())

    collide_and_push(box, box2)


    if key[pygame.K_SPACE] == True:
        page = 2
    elif key[pygame.K_ESCAPE] == True:
        page = 1

    if page == 2:
        second_page()
    elif page == 1:
        first_page()
    
    pygame.draw.rect(screen, (255, 255, 255), box)
    pygame.draw.rect(screen, (0, 255, 0), box2)

    pygame.display.update()