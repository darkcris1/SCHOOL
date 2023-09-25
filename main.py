import pygame
import sys
import random





# Initialize pygame
pygame.init()

# Constants
SCREEN_WIDTH, SCREEN_HEIGHT = 800, 600
WHITE, RED, GOLD = (255, 255, 255), (255, 0, 0), (255, 215, 0)
FPS = 60

# Create the screen
screen = pygame.display.set_mode((SCREEN_WIDTH, SCREEN_HEIGHT))
pygame.display.set_caption("Shooting Game")

clock = pygame.time.Clock()

# Bullet setup
bullet_size, bullet_speed = 10, 10
bullets_group = pygame.sprite.Group()

# Level setup
current_level, level_enemy_count = 1, 10

# Shooting sound
shooting_sound = pygame.mixer.Sound("assets/sounds/shooting_sound.mp3")

# Shooting delay setup
last_shot_time, shoot_delay = 0, 100  # milliseconds

# Game states
MENU, GAME, HELP = 0, 1, 3
game_state = MENU

# Menu setup
font = pygame.font.Font(None, 36)
start_text = font.render("Press SPACE to Start", True, GOLD)
start_rect = start_text.get_rect(center=(SCREEN_WIDTH // 2, SCREEN_HEIGHT // 2))

# Score setup
score, score_font = 0, pygame.font.Font(None, 24)

# Highest score setup
highest_score, highest_score_font = 0, pygame.font.Font(None, 24)

# Load highest score from file
try:
    with open("highest_score.txt", "r") as file:
        highest_score = int(file.read() or 0)
except FileNotFoundError:
    pass

# Life setup
lifelines, life_font = 5, pygame.font.Font(None, 24)

# Player setup
class Player(pygame.sprite.Sprite):
    def __init__(self):
        super().__init__()
        self.image = pygame.image.load("assets/characters/player.png")
        self.image = pygame.transform.scale(self.image, (50, 50))
        self.rect = self.image.get_rect()
        self.rect.centerx = SCREEN_WIDTH // 2
        self.rect.bottom = SCREEN_HEIGHT - 10
        self.speed = 5

    def update(self):
        # Player controls using mouse
        player_x = pygame.mouse.get_pos()[0] - self.rect.width // 2
        player_x = max(0, min(player_x, SCREEN_WIDTH - self.rect.width))
        self.rect.x = player_x

# Create player sprite
player_sprite = Player()
player_group = pygame.sprite.Group(player_sprite)

# Enemy setup
class Enemy(pygame.sprite.Sprite):
    enemy_images = [
        pygame.image.load("assets/characters/enemies/ship_0000.png"),
        pygame.image.load("assets/characters/enemies/ship_0001.png"),
        pygame.image.load("assets/characters/enemies/ship_0002.png"),
        pygame.image.load("assets/characters/enemies/ship_0003.png"),
        pygame.image.load("assets/characters/enemies/ship_0004.png")
    ]

    def __init__(self):
        super().__init__()
        self.image = random.choice(Enemy.enemy_images)
        self.image = pygame.transform.scale(self.image, (50, 50))
        self.image = pygame.transform.rotate(self.image, 180)
        self.rect = self.image.get_rect()
        self.rect.x = random.randint(0, SCREEN_WIDTH - self.rect.width)
        self.rect.y = random.randint(-100, -50)
        self.speed = random.randint(1, 3)
        self.direction = random.choice([-1, 1])  # Randomly select left (-1) or right (1) direction


    def update(self):
        # Move horizontally in the selected direction
        self.rect.x += self.speed * self.direction

        # Wrap around the screen horizontally
        if self.rect.right > SCREEN_WIDTH:
            self.direction = -1
        elif self.rect.left < 0:
            self.direction = 1

        # Move vertically
        self.rect.y += self.speed

# Create enemy sprite group
enemies_group = pygame.sprite.Group()

# Bullet setup
class Bullet(pygame.sprite.Sprite):
    def __init__(self, x, y):
        super().__init__()
        self.image = pygame.Surface((bullet_size, bullet_size))
        self.image.fill(GOLD)
        self.rect = self.image.get_rect()
        self.rect.center = (x, y)

    def update(self):
        self.rect.y -= bullet_speed
        if self.rect.bottom < 0:
            self.kill()  # Remove bullet when it goes out of the screen


# Background setup
background = pygame.image.load("assets/backgrounds/DarkBackground.png")  # Replace with your background image path
background = pygame.transform.scale(background, (SCREEN_WIDTH, SCREEN_HEIGHT * 2))
background_rect = background.get_rect()
background_y = 0


# Menu background setup
menu_background = pygame.image.load("assets/backgrounds/DarkBackground.png")  # Replace with your menu background image path
menu_background = pygame.transform.scale(menu_background, (SCREEN_WIDTH, SCREEN_HEIGHT))


# Menu buttons setup
start_button = pygame.Rect(SCREEN_WIDTH // 2 - 100, SCREEN_HEIGHT // 2 - 25, 200, 50)
help_button = pygame.Rect(SCREEN_WIDTH // 2 - 100, SCREEN_HEIGHT // 2 + 50, 200, 50)
highest_button = pygame.Rect(SCREEN_WIDTH // 2 - 100, SCREEN_HEIGHT // 2 + 125, 200, 50)

# Back button setup
back_button = pygame.Rect(10, 10, 100, 30)
back_button_color = GOLD
back_hover_color = RED

# Button colors
button_color = GOLD
hover_color = RED

def draw_menu():
    screen.blit(menu_background, (0,0))

    # Draw "Start Game" button
    pygame.draw.rect(screen, button_color, start_button)
    start_text = font.render("Start Game", True, WHITE)
    start_rect = start_text.get_rect(center=start_button.center)
    screen.blit(start_text, start_rect)

    # Draw "Help" button
    pygame.draw.rect(screen, button_color, help_button)
    help_text = font.render("Help", True, WHITE)
    help_rect = help_text.get_rect(center=help_button.center)
    screen.blit(help_text, help_rect)


    pygame.draw.rect(screen, WHITE, highest_button)
    highest_score_text = highest_score_font.render(f"Highest Score: {highest_score}", True, RED)
    highest_score_rect = highest_score_text.get_rect(center=highest_button.center)
    screen.blit(highest_score_text, highest_score_rect)

# Help screen setup
help_text = """
Welcome to the Shooting Game!

Controls:
- Move the player using the mouse.
- Click the left mouse button to shoot.

Objective:
- Shoot down as many enemies as you can.
- Avoid enemies reaching the bottom of the screen.
- You have 5 lives to start with.

Press SPACE to Start
"""
help_font = pygame.font.Font(None, 24)
help_rect = pygame.Rect(50, 50, SCREEN_WIDTH - 100, SCREEN_HEIGHT - 100)

def draw_help():
    screen.blit(menu_background, (0,0))

    pygame.draw.rect(screen, button_color, help_rect)
    help_lines = help_text.split('\n')
    for i, line in enumerate(help_lines):
        text_surface = help_font.render(line, True, RED)
        text_rect = text_surface.get_rect(center=(SCREEN_WIDTH // 2, 100 + i * 30))
        screen.blit(text_surface, text_rect)

    # Draw back button
    pygame.draw.rect(screen, back_button_color, back_button)
    back_text = font.render("Back", True, WHITE)
    back_rect = back_text.get_rect(center=back_button.center)
    screen.blit(back_text, back_rect)

# Game loop
def game_loop():
    global game_state, score, lifelines, highest_score, last_shot_time, background_y
    
    last_shot_time = 0  # Initialize last_shot_time here
    
    running = True
    while running:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                running = False
            elif event.type == pygame.KEYDOWN:
                if event.key == pygame.K_SPACE and game_state == MENU:
                    game_state = GAME
                elif event.key == pygame.K_h and game_state == MENU:
                    game_state = HELP
        
        if game_state == MENU:
            draw_menu()
            mouse_pos = pygame.mouse.get_pos()
            mouse_clicked = pygame.mouse.get_pressed()

            # Check if "Start Game" button is clicked
            if start_button.collidepoint(mouse_pos) and mouse_clicked[0]:
                game_state = GAME

            # Check if "Help" button is clicked
            if help_button.collidepoint(mouse_pos) and mouse_clicked[0]:
                game_state = HELP


        elif game_state == HELP:
            draw_help()
            mouse_pos = pygame.mouse.get_pos()
            mouse_clicked = pygame.mouse.get_pressed()

            # Check if "Back" button is clicked
            if back_button.collidepoint(mouse_pos) and mouse_clicked[0]:
                game_state = MENU

        elif game_state == GAME:

            # Update background position for scrolling effect along the Y-axis
            background_y += 1  # Adjust the scrolling speed as needed
            if background_y > background_rect.height:
                background_y = 0  # Reset the background position

            # Draw scrolling background
            screen.blit(background, (0, -background_y))
            screen.blit(background, (0, background_rect.height - background_y))


            # Shooting using mouse click with delay
            current_time = pygame.time.get_ticks()
            if pygame.mouse.get_pressed()[0] and current_time - last_shot_time > shoot_delay:
                bullet = Bullet(player_sprite.rect.centerx, player_sprite.rect.top)
                bullets_group.add(bullet)
                shooting_sound.play()
                last_shot_time = current_time
            
            # Update bullets
            bullets_group.update()

            # Update enemies
            enemies_group.update()
            
            # Check for collisions between player and enemies
            player_enemy_collisions = pygame.sprite.spritecollide(player_sprite, enemies_group, True)

            # If a collision occurs, decrease lifelines and remove the enemy sprite
            if player_enemy_collisions:
                lifelines -= 1

            # Spawn new enemies
            while len(enemies_group) < level_enemy_count:
                enemy = Enemy()
                enemies_group.add(enemy)

            # Check for collisions
            hits = pygame.sprite.groupcollide(enemies_group, bullets_group, True, True)
            for _ in hits:
                score += 1

            # Check for enemies reaching the bottom
            for enemy in enemies_group:
                if enemy.rect.top > SCREEN_HEIGHT:
                    lifelines -= 1
                    enemies_group.remove(enemy)

            # Update player
            player_group.update()

            # Draw player
            player_group.draw(screen)

            # Draw bullets
            bullets_group.draw(screen)

            # Draw enemies
            enemies_group.draw(screen)

            # Update highest score if needed
            if score > highest_score:
                highest_score = score

            # Draw score
            screen.blit(score_font.render(f"Score: {score}", True, WHITE), (10, 10))

            # Draw lifelines
            screen.blit(life_font.render(f"Lives: {lifelines}", True, WHITE), (10, 40))

            # Draw highest score
            screen.blit(highest_score_font.render(f"Highest: {highest_score}", True, WHITE), (10, 70))
            
            # Game over condition
            if lifelines <= 0:
                game_state = MENU
                lifelines, score = 5, 0
                enemies_group.empty()
        
        # Save highest score to file
        with open("highest_score.txt", "w") as file:
            file.write(str(highest_score))
        pygame.display.flip()
        clock.tick(FPS)

    pygame.quit()
    sys.exit()

if __name__ == "__main__":
    game_loop()
