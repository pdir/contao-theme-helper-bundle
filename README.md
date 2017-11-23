# pdir/contao-theme-helper-bundle

add helper functions for contao themes

# german version

## Verwendung

Globale Inhalte werden über Ordner verwaltet und jeder Bereich bekommt
einen eigenen Artikel und ein Theme Tag zugewiesen. Über die
Artikeleigenschaften können verfügbare Tags zugewiesen werden.

### Aufbau Tag

THEME/BEREICH/ID

##### Beispiel

Mate Theme

MATE01/01 Kopfbereich Öffnungszeiten

##### Insert Tag
{{theme::content::MATE01/01}}

### verfügbare Tags

Tags werden von den verfügbaren Themes in der config.php registriert.

# Available Themes
- Mate Theme für Contao | Tags

# english version
