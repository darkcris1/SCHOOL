import pygame
import sys
import random

# Initialize pygame
pygame.init()

# Constants
SCREEN_WIDTH = 800
SCREEN_HEIGHT = 600
FPS = 60

# Colors
WHITE = (255, 255, 255)
RED = (255, 0, 0)
GREEN = (0, 128, 0)
GOLD = (255, 215, 0)


# Create the screen
screen = pygame.display.set_mode((SCREEN_WIDTH, SCREEN_HEIGHT))
pygame.display.set_caption("Shooting Game")

clock = pygame.time.Clock()

# Player setup
player_size = 50
player_x = SCREEN_WIDTH // 2 - player_size // 2
player_y = SCREEN_HEIGHT - player_size
player_speed = 5

# Bullet setup
bullet_size = 10
bullet_speed = 10
bullets = []

# Enemy setup
enemy_size = 50
enemy_speed = 3
enemies = []

# Level setup
current_level = 1
level_enemy_count = 5

# Shooting sound
shooting_sound = pygame.mixer.Sound("assets/sounds/shooting_sound.mp3")

# Load enemy image
enemy_image = pygame.image.load("assets/characters/slime.png")  # Replace with the actual enemy image path
enemy_size = 50

# Shooting delay setup
last_shot_time = 0
shoot_delay = 100  # milliseconds

# Game states
MENU = 0
GAME = 1
game_state = MENU

# Menu setup
font = pygame.font.Font(None, 36)
start_text = font.render("Press SPACE to Start", True, GREEN)
start_rect = start_text.get_rect(center=(SCREEN_WIDTH // 2, SCREEN_HEIGHT // 2))

# Score setup
score = 0
score_font = pygame.font.Font(None, 24)

# Highest score setup
highest_score = 0
highest_score_font = pygame.font.Font(None, 24)

# Load highest score from file
try:
    with open("highest_score.txt", "r") as file:
        highest_score = int(file.read() or 0)
except FileNotFoundError:
    pass

# Life setup
lifelines = 5
life_font = pygame.font.Font(None, 24)

# Game loop
def game_loop():
    global bullets, enemies, last_shot_time, game_state, score, lifelines, highest_score
    
    running = True
    while running:
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                running = False
            elif event.type == pygame.KEYDOWN:
                if event.key == pygame.K_SPACE and game_state == MENU:
                    game_state = GAME

        
        if game_state == MENU:
            screen.fill(WHITE)
            screen.blit(start_text, start_rect)
            highest_score_text = highest_score_font.render(f"Highest Score: {highest_score}", True, RED)
            highest_score_rect = highest_score_text.get_rect(center=(SCREEN_WIDTH // 2, SCREEN_HEIGHT // 2 + 50))
            screen.blit(highest_score_text, highest_score_rect)
        elif game_state == GAME:
            # Player controls using mouse
            player_x = pygame.mouse.get_pos()[0] - player_size // 2
            if player_x < 0:
                player_x = 0
            if player_x > SCREEN_WIDTH - player_size:
                player_x = SCREEN_WIDTH - player_size

            # Shooting using mouse click with delay
            current_time = pygame.time.get_ticks()
            if pygame.mouse.get_pressed()[0] and current_time - last_shot_time > shoot_delay:  # Left mouse button
                bullets.append([player_x + player_size // 2, player_y])
                shooting_sound.play()  # Play shooting sound
                last_shot_time = current_time  # Update last shot time

            # Update bullets
            for bullet in bullets:
                bullet[1] -= bullet_speed
                if bullet[1] < 0:
                    bullets.remove(bullet)

            # Update enemies
            if len(enemies) < level_enemy_count:
                enemies.append([random.randint(0, SCREEN_WIDTH - enemy_size), 0])

            for enemy in enemies:
                enemy[1] += enemy_speed
                if enemy[1] > SCREEN_HEIGHT:
                    enemies.remove(enemy)

            # Check for collisions
            for enemy in enemies:
                for bullet in bullets:
                    if bullet[1] < enemy[1] + enemy_size and \
                    bullet[0] > enemy[0] and bullet[0] < enemy[0] + enemy_size:
                        bullets.remove(bullet)
                        if enemy in enemies:
                            enemies.remove(enemy)
                            score += 1  # Increment score when an enemy is hit

             # Check for enemies reaching the bottom
            for enemy in enemies:
                if enemy[1] >= SCREEN_HEIGHT:
                    enemies.remove(enemy)
                    lifelines -= 1  # Deduct a life if an enemy passes through

            # Clear the screen
            screen.fill(WHITE)

            # Draw player
            pygame.draw.rect(screen, RED, (player_x, player_y, player_size, player_size))

            # Draw bullets
            for bullet in bullets:
                pygame.draw.rect(screen, GOLD, (bullet[0], bullet[1], bullet_size, bullet_size))

            # Draw enemies using images
            for enemy in enemies:
                screen.blit(enemy_image, (enemy[0], enemy[1]))

             # Update highest score if needed
            if score > highest_score:
                highest_score = score

            # Draw score
            score_text = score_font.render(f"Score: {score}", True, RED)
            screen.blit(score_text, (10, 10))

             # Draw lifelines
            life_text = life_font.render(f"Lives: {lifelines}", True, RED)
            screen.blit(life_text, (10, 40))

            # Draw highest score
            highest_score_text = score_font.render(f"Highest: {highest_score}", True, RED)
            screen.blit(highest_score_text, (10, 70))
            
            # Game over condition
            if lifelines <= 0:
                game_state = MENU
                lifelines = 5  # Reset lifelines
                score = 0  # Reset lifelines

        
        # Save highest score to file
        with open("highest_score.txt", "w") as file:
            file.write(str(highest_score))
        pygame.display.flip()
        clock.tick(FPS)

    pygame.quit()
    sys.exit()

if __name__ == "__main__":
    game_loop()
